<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the File class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single File object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FileEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FileEditFormBase extends QForm {
		// General Form Variables
		protected $objFile;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for File's Data Fields
		protected $lblId;
		protected $lstDirectory;
		protected $txtPath;
		protected $txtDeprecatedMajorVersion;
		protected $txtDeprecatedMinorVersion;
		protected $txtDeprecatedBuild;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFile() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objFile = File::Load(($intId));

				if (!$this->objFile)
					throw new Exception('Could not find a File object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFile = new File();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFile to either Load/Edit Existing or Create New
			$this->SetupFile();

			// Create/Setup Controls for File's Data Fields
			$this->lblId_Create();
			$this->lstDirectory_Create();
			$this->txtPath_Create();
			$this->txtDeprecatedMajorVersion_Create();
			$this->txtDeprecatedMinorVersion_Create();
			$this->txtDeprecatedBuild_Create();

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
				$this->lblId->Text = $this->objFile->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstDirectory
		protected function lstDirectory_Create() {
			$this->lstDirectory = new QListBox($this);
			$this->lstDirectory->Name = QApplication::Translate('Directory');
			$this->lstDirectory->Required = true;
			if (!$this->blnEditMode)
				$this->lstDirectory->AddItem(QApplication::Translate('- Select One -'), null);
			$objDirectoryArray = DirectoryToken::LoadAll();
			if ($objDirectoryArray) foreach ($objDirectoryArray as $objDirectory) {
				$objListItem = new QListItem($objDirectory->__toString(), $objDirectory->Id);
				if (($this->objFile->Directory) && ($this->objFile->Directory->Id == $objDirectory->Id))
					$objListItem->Selected = true;
				$this->lstDirectory->AddItem($objListItem);
			}
		}

		// Create and Setup txtPath
		protected function txtPath_Create() {
			$this->txtPath = new QTextBox($this);
			$this->txtPath->Name = QApplication::Translate('Path');
			$this->txtPath->Text = $this->objFile->Path;
			$this->txtPath->Required = true;
		}

		// Create and Setup txtDeprecatedMajorVersion
		protected function txtDeprecatedMajorVersion_Create() {
			$this->txtDeprecatedMajorVersion = new QIntegerTextBox($this);
			$this->txtDeprecatedMajorVersion->Name = QApplication::Translate('Deprecated Major Version');
			$this->txtDeprecatedMajorVersion->Text = $this->objFile->DeprecatedMajorVersion;
		}

		// Create and Setup txtDeprecatedMinorVersion
		protected function txtDeprecatedMinorVersion_Create() {
			$this->txtDeprecatedMinorVersion = new QIntegerTextBox($this);
			$this->txtDeprecatedMinorVersion->Name = QApplication::Translate('Deprecated Minor Version');
			$this->txtDeprecatedMinorVersion->Text = $this->objFile->DeprecatedMinorVersion;
		}

		// Create and Setup txtDeprecatedBuild
		protected function txtDeprecatedBuild_Create() {
			$this->txtDeprecatedBuild = new QIntegerTextBox($this);
			$this->txtDeprecatedBuild->Name = QApplication::Translate('Deprecated Build');
			$this->txtDeprecatedBuild->Text = $this->objFile->DeprecatedBuild;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'File')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFileFields() {
			$this->objFile->DirectoryId = $this->lstDirectory->SelectedValue;
			$this->objFile->Path = $this->txtPath->Text;
			$this->objFile->DeprecatedMajorVersion = $this->txtDeprecatedMajorVersion->Text;
			$this->objFile->DeprecatedMinorVersion = $this->txtDeprecatedMinorVersion->Text;
			$this->objFile->DeprecatedBuild = $this->txtDeprecatedBuild->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFileFields();
			$this->objFile->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objFile->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('file_list.php');
		}
	}
?>