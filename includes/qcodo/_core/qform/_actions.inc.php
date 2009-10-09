<?php
	abstract class QAction extends QBaseClass {
		abstract public function RenderScript(QControl $objControl);

		protected $objEvent;

		public static function RenderActions(QControl $objControl, $strEventName, $objActions) {
			$strToReturn = '';

			if ($objActions) foreach ($objActions as $objAction) {
				if ($objAction->objEvent->JavaScriptEvent != $strEventName)
					throw new Exception('Invalid Action Event in this entry in the ActionArray');

				if ($objAction->objEvent->Delay > 0) {
					$strCode = sprintf(" qcodo.setTimeout('%s', '%s', %s);",
						$objControl->ControlId,
						addslashes($objAction->RenderScript($objControl)),
						$objAction->objEvent->Delay);
				} else {
					$strCode = ' ' . $objAction->RenderScript($objControl);
				}

				// Add Condition (if applicable)
				if (strlen($objAction->objEvent->Condition))
					$strCode = sprintf(' if (%s) {%s}', $objAction->objEvent->Condition, trim($strCode));

				// Append it to the Return Value
				$strToReturn .= $strCode;
			}

			if ($objControl->ActionsMustTerminate)
				$strToReturn .= ' return false;';

			if (count($strToReturn))
				return sprintf('%s="%s" ', $strEventName, substr($strToReturn, 1));
			else
				return null;
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'Event':
					return ($this->objEvent = QType::Cast($mixValue, 'QEvent'));

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
		
		public function __get($strName) {
			switch ($strName) {
				case 'Event': return $this->objEvent;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

	class QServerAction extends QAction {
		protected $strMethodName;

		public function __construct($strMethodName = null) {
			$this->strMethodName = $strMethodName;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'MethodName':
					return $this->strMethodName;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function RenderScript(QControl $objControl) {
			return sprintf("qc.pB('%s', '%s', '%s', '%s');",
				$objControl->Form->FormId, $objControl->ControlId, get_class($this->objEvent), addslashes($objControl->ActionParameter));
		}
	}

	class QAjaxAction extends QAction {
		protected $strMethodName;
		protected $objWaitIconControl;

		public function __construct($strMethodName = null, $objWaitIconControl = 'default') {
			$this->strMethodName = $strMethodName;
			$this->objWaitIconControl = $objWaitIconControl;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'MethodName':
					return $this->strMethodName;
				case 'WaitIconControl':
					return $this->objWaitIconControl;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function RenderScript(QControl $objControl) {
			$strWaitIconControlId = null;
			if ((gettype($this->objWaitIconControl) == 'string') && ($this->objWaitIconControl == 'default')) {
				if ($objControl->Form->DefaultWaitIcon)
					$strWaitIconControlId = $objControl->Form->DefaultWaitIcon->ControlId;
			} else if ($this->objWaitIconControl) {
				$strWaitIconControlId = $this->objWaitIconControl->ControlId;
			}

			return sprintf("qc.pA('%s', '%s', '%s', '%s', '%s');",
				$objControl->Form->FormId, $objControl->ControlId, get_class($this->objEvent), addslashes($objControl->ActionParameter), $strWaitIconControlId);
		}
	}

	class QServerControlAction extends QServerAction {
		public function __construct(QControl $objControl, $strMethodName) {
			parent::__construct($objControl->ControlId . ':' . $strMethodName);
		}
	}

	class QAjaxControlAction extends QAjaxAction {
		public function __construct(QControl $objControl, $strMethodName, $objWaitIconControl = 'default') {
			parent::__construct($objControl->ControlId . ':' . $strMethodName, $objWaitIconControl);
		}
	}

	class QJavaScriptAction extends QAction {
		protected $strJavaScript;

		public function __construct($strJavaScript) {
			$this->strJavaScript = trim($strJavaScript);
			if (QString::LastCharacter($this->strJavaScript) == ';')
				$this->strJavaScript = substr($this->strJavaScript, 0, strlen($this->strJavaScript) - 1);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'JavaScript':
					return $this->strJavaScript;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function RenderScript(QControl $objControl) {
			return sprintf('%s;', $this->strJavaScript);
		}
	}

	class QConfirmAction extends QAction {
		protected $strMessage;

		public function __construct($strMessage) {
			$this->strMessage = $strMessage;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'Message':
					return $this->strMessage;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function RenderScript(QControl $objControl) {
			return sprintf("if (!confirm('%s')) return false;", addslashes($this->strMessage));
		}
	}

	class QAlertAction extends QAction {
		protected $strMessage;

		public function __construct($strMessage) {
			$this->strMessage = $strMessage;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'Message':
					return $this->strMessage;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function RenderScript(QControl $objControl) {
			return sprintf("alert('%s');", addslashes($this->strMessage));
		}
	}

	class QResetTimerAction extends QAction {
		public function RenderScript(QControl $objControl) {
			return sprintf("qcodo.clearTimeout('%s');", $objControl->ControlId);
		}
	}
	
	class QTerminateAction extends QAction {
		public function RenderScript(QControl $objControl) {
			return sprintf('return false;', $objControl->ControlId);
//			return 'return qc.terminatesEvent(event);';
		}
	}

	class QToggleDisplayAction extends QAction {
		protected $strControlId = null;
		protected $blnDisplay = null;

		public function __construct($objControl, $blnDisplay = null) {
			if (!($objControl instanceof QControl))
				throw new QCallerException('First parameter of constructor is expecting an object of type QControl');

			$this->strControlId = $objControl->ControlId;

			if (!is_null($blnDisplay))
				$this->blnDisplay = QType::Cast($blnDisplay, QType::Boolean);
		}

		public function RenderScript(QControl $objControl) {
			if ($this->blnDisplay === true)
				$strShowOrHide = 'show';
			else if ($this->blnDisplay === false)
				$strShowOrHide = 'hide';
			else
				$strShowOrHide = '';

			return sprintf("qc.getW('%s').toggleDisplay('%s');",
				$this->strControlId, $strShowOrHide);
		}
	}

	class QToggleEnableAction extends QAction {
		protected $strControlId = null;
		protected $blnEnabled = null;

		public function __construct($objControl, $blnEnabled = null) {
			if (!($objControl instanceof QControl))
				throw new QCallerException('First parameter of constructor is expecting an object of type QControl');

			$this->strControlId = $objControl->ControlId;

			if (!is_null($blnEnabled))
				$this->blnEnabled = QType::Cast($blnEnabled, QType::Boolean);
		}

		public function RenderScript(QControl $objControl) {
			if ($this->blnEnabled === true)
				$strEnableOrDisable = 'enable';
			else if ($this->blnEnabled === false)
				$strEnableOrDisable = 'disable';
			else
				$strEnableOrDisable = '';

			return sprintf("qc.getW('%s').toggleEnabled('%s');", $this->strControlId, $strEnableOrDisable);
		}
	}
	
	class QRegisterClickPositionAction extends QAction {
		protected $strControlId = null;

		public function RenderScript(QControl $objControl) {
			return sprintf("qc.getW('%s').registerClickPosition(event);", $objControl->ControlId);
		}
	}

	class QFocusControlAction extends QAction {
		protected $strControlId = null;

		public function __construct($objControl) {
			if (!($objControl instanceof QControl))
    			throw new QCallerException('First parameter of constructor is expecting an object of type QControl');

			$this->strControlId = $objControl->ControlId;
		}

		public function RenderScript(QControl $objControl) {
			return sprintf("qc.getW('%s').focus();", $this->strControlId);
		}
	}
?>