<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the Person class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single Person object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this PersonEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class PersonEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objPerson;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for Person's Data Fields
		public $lblId;
		public $lstPersonType;
		public $txtUsername;
		public $txtPassword;
		public $txtFirstName;
		public $txtLastName;
		public $txtEmail;
		public $chkDisplayRealNameFlag;
		public $chkDisplayEmailFlag;
		public $chkOptInFlag;
		public $chkDonatedFlag;
		public $txtLocation;
		public $txtCountryId;
		public $txtUrl;
		public $calRegistrationDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupPerson($objPerson) {
			if ($objPerson) {
				$this->objPerson = $objPerson;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objPerson = new Person();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objPerson = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupPerson to either Load/Edit Existing or Create New
			$this->SetupPerson($objPerson);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for Person's Data Fields
			$this->lblId_Create();
			$this->lstPersonType_Create();
			$this->txtUsername_Create();
			$this->txtPassword_Create();
			$this->txtFirstName_Create();
			$this->txtLastName_Create();
			$this->txtEmail_Create();
			$this->chkDisplayRealNameFlag_Create();
			$this->chkDisplayEmailFlag_Create();
			$this->chkOptInFlag_Create();
			$this->chkDonatedFlag_Create();
			$this->txtLocation_Create();
			$this->txtCountryId_Create();
			$this->txtUrl_Create();
			$this->calRegistrationDate_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblId
		protected function lblId_Create() {
			$this->lblId = new QLabel($this);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objPerson->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstPersonType
		protected function lstPersonType_Create() {
			$this->lstPersonType = new QListBox($this);
			$this->lstPersonType->Name = QApplication::Translate('Person Type');
			$this->lstPersonType->Required = true;
			foreach (PersonType::$NameArray as $intId => $strValue)
				$this->lstPersonType->AddItem(new QListItem($strValue, $intId, $this->objPerson->PersonTypeId == $intId));
		}

		// Create and Setup txtUsername
		protected function txtUsername_Create() {
			$this->txtUsername = new QTextBox($this);
			$this->txtUsername->Name = QApplication::Translate('Username');
			$this->txtUsername->Text = $this->objPerson->Username;
			$this->txtUsername->Required = true;
		}

		// Create and Setup txtPassword
		protected function txtPassword_Create() {
			$this->txtPassword = new QTextBox($this);
			$this->txtPassword->Name = QApplication::Translate('Password');
			$this->txtPassword->Text = $this->objPerson->Password;
		}

		// Create and Setup txtFirstName
		protected function txtFirstName_Create() {
			$this->txtFirstName = new QTextBox($this);
			$this->txtFirstName->Name = QApplication::Translate('First Name');
			$this->txtFirstName->Text = $this->objPerson->FirstName;
			$this->txtFirstName->Required = true;
		}

		// Create and Setup txtLastName
		protected function txtLastName_Create() {
			$this->txtLastName = new QTextBox($this);
			$this->txtLastName->Name = QApplication::Translate('Last Name');
			$this->txtLastName->Text = $this->objPerson->LastName;
			$this->txtLastName->Required = true;
		}

		// Create and Setup txtEmail
		protected function txtEmail_Create() {
			$this->txtEmail = new QTextBox($this);
			$this->txtEmail->Name = QApplication::Translate('Email');
			$this->txtEmail->Text = $this->objPerson->Email;
			$this->txtEmail->Required = true;
		}

		// Create and Setup chkDisplayRealNameFlag
		protected function chkDisplayRealNameFlag_Create() {
			$this->chkDisplayRealNameFlag = new QCheckBox($this);
			$this->chkDisplayRealNameFlag->Name = QApplication::Translate('Display Real Name Flag');
			$this->chkDisplayRealNameFlag->Checked = $this->objPerson->DisplayRealNameFlag;
		}

		// Create and Setup chkDisplayEmailFlag
		protected function chkDisplayEmailFlag_Create() {
			$this->chkDisplayEmailFlag = new QCheckBox($this);
			$this->chkDisplayEmailFlag->Name = QApplication::Translate('Display Email Flag');
			$this->chkDisplayEmailFlag->Checked = $this->objPerson->DisplayEmailFlag;
		}

		// Create and Setup chkOptInFlag
		protected function chkOptInFlag_Create() {
			$this->chkOptInFlag = new QCheckBox($this);
			$this->chkOptInFlag->Name = QApplication::Translate('Opt In Flag');
			$this->chkOptInFlag->Checked = $this->objPerson->OptInFlag;
		}

		// Create and Setup chkDonatedFlag
		protected function chkDonatedFlag_Create() {
			$this->chkDonatedFlag = new QCheckBox($this);
			$this->chkDonatedFlag->Name = QApplication::Translate('Donated Flag');
			$this->chkDonatedFlag->Checked = $this->objPerson->DonatedFlag;
		}

		// Create and Setup txtLocation
		protected function txtLocation_Create() {
			$this->txtLocation = new QTextBox($this);
			$this->txtLocation->Name = QApplication::Translate('Location');
			$this->txtLocation->Text = $this->objPerson->Location;
		}

		// Create and Setup txtCountryId
		protected function txtCountryId_Create() {
			$this->txtCountryId = new QIntegerTextBox($this);
			$this->txtCountryId->Name = QApplication::Translate('Country Id');
			$this->txtCountryId->Text = $this->objPerson->CountryId;
		}

		// Create and Setup txtUrl
		protected function txtUrl_Create() {
			$this->txtUrl = new QTextBox($this);
			$this->txtUrl->Name = QApplication::Translate('Url');
			$this->txtUrl->Text = $this->objPerson->Url;
		}

		// Create and Setup calRegistrationDate
		protected function calRegistrationDate_Create() {
			$this->calRegistrationDate = new QDateTimePicker($this);
			$this->calRegistrationDate->Name = QApplication::Translate('Registration Date');
			$this->calRegistrationDate->DateTime = $this->objPerson->RegistrationDate;
			$this->calRegistrationDate->DateTimePickerType = QDateTimePickerType::DateTime;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Person')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdatePersonFields() {
			$this->objPerson->PersonTypeId = $this->lstPersonType->SelectedValue;
			$this->objPerson->Username = $this->txtUsername->Text;
			$this->objPerson->Password = $this->txtPassword->Text;
			$this->objPerson->FirstName = $this->txtFirstName->Text;
			$this->objPerson->LastName = $this->txtLastName->Text;
			$this->objPerson->Email = $this->txtEmail->Text;
			$this->objPerson->DisplayRealNameFlag = $this->chkDisplayRealNameFlag->Checked;
			$this->objPerson->DisplayEmailFlag = $this->chkDisplayEmailFlag->Checked;
			$this->objPerson->OptInFlag = $this->chkOptInFlag->Checked;
			$this->objPerson->DonatedFlag = $this->chkDonatedFlag->Checked;
			$this->objPerson->Location = $this->txtLocation->Text;
			$this->objPerson->CountryId = $this->txtCountryId->Text;
			$this->objPerson->Url = $this->txtUrl->Text;
			$this->objPerson->RegistrationDate = $this->calRegistrationDate->DateTime;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdatePersonFields();
			$this->objPerson->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objPerson->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>