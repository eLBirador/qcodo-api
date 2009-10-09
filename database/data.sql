ALTER TABLE file ADD UNIQUE KEY uq_file_1(directory_id, path);
ALTER TABLE operation ADD UNIQUE KEY uq_operation_1(qcodo_class_id, qcodo_interface_id, name);
ALTER TABLE class_property ADD INDEX ix_classproperty_1(qcodo_class_id, variable_group_id);
ALTER TABLE class_variable ADD INDEX ix_classvariable_1(qcodo_class_id, variable_group_id);

INSERT INTO protection_type(id, name) VALUES (1, 'Public');
INSERT INTO protection_type(id, name) VALUES (2, 'Protected');
INSERT INTO protection_type(id, name) VALUES (3, 'Private');

INSERT INTO variable_type(id, name) VALUES (1, 'Unknown');
INSERT INTO variable_type(id, name) VALUES (2, 'String');
INSERT INTO variable_type(id, name) VALUES (3, 'Integer');
INSERT INTO variable_type(id, name) VALUES (4, 'Float');
INSERT INTO variable_type(id, name) VALUES (5, 'Boolean');
INSERT INTO variable_type(id, name) VALUES (6, 'Mixed');
INSERT INTO variable_type(id, name) VALUES (7, 'QDateTime');
INSERT INTO variable_type(id, name) VALUES (8, 'Resource');
INSERT INTO variable_type(id, name) VALUES (9, 'Object');

INSERT INTO variable_group(id, name, order_number) VALUES (1, 'Unclassified', 7);
INSERT INTO variable_group(id, name, order_number) VALUES (2, 'Appearance', 1);
INSERT INTO variable_group(id, name, order_number) VALUES (3, 'Behavior', 2);
INSERT INTO variable_group(id, name, order_number) VALUES (4, 'Internal', 3);
INSERT INTO variable_group(id, name, order_number) VALUES (5, 'Layout', 4);
INSERT INTO variable_group(id, name, order_number) VALUES (6, 'Miscellaneous', 5);
INSERT INTO variable_group(id, name, order_number) VALUES (7, 'Settings', 6);

INSERT INTO class_group(id, name, order_number) VALUES (1, 'PHP Classes', 12);
INSERT INTO class_group(id, name, order_number) VALUES (2, 'Core Framework', 1);
INSERT INTO class_group(id, name, order_number) VALUES (3, 'Code Generator', 2);
INSERT INTO class_group(id, name, order_number) VALUES (4, 'QForm and QControls', 7);
INSERT INTO class_group(id, name, order_number) VALUES (5, 'QForm Actions', 8);
INSERT INTO class_group(id, name, order_number) VALUES (6, 'QForm Events', 9);
INSERT INTO class_group(id, name, order_number) VALUES (7, 'QForm Enumerations', 10);
INSERT INTO class_group(id, name, order_number) VALUES (8, 'Database and Adapters', 3);
INSERT INTO class_group(id, name, order_number) VALUES (9, 'Qcodo Query', 6);
INSERT INTO class_group(id, name, order_number) VALUES (10, 'Email and WebServices', 4);
INSERT INTO class_group(id, name, order_number) VALUES (11, 'Core Exceptions', 11);
INSERT INTO class_group(id, name, order_number) VALUES (12, 'Internationalization', 5);

INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__DOCROOT__', 'wwwroot/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__DEVTOOLS_CLI__', '_devtools_cli/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__INCLUDES__', 'wwwroot/includes/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__QCODO__', 'wwwroot/includes/qcodo/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__QCODO_CORE__', 'wwwroot/includes/qcodo/_core/', true, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__DATA_CLASSES__', 'wwwroot/includes/data_classes/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__DATAGEN_CLASSES__', 'wwwroot/includes/data_classes/generated/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__FORMBASE_CLASSES__', 'wwwroot/includes/formbase_classes_generated/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__PANELBASE_CLASSES__', 'wwwroot/includes/panelbase_classes_generated/', false, false);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__DEVTOOLS__', 'wwwroot/_devtools/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__FORM_DRAFTS__', 'wwwroot/form_drafts/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__EXAMPLES__', 'wwwroot/examples/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__JS_ASSETS__', 'wwwroot/assets/js/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__CSS_ASSETS__', 'wwwroot/assets/css/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__IMAGE_ASSETS__', 'wwwroot/assets/images/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__PHP_ASSETS__', 'wwwroot/assets/php/', false, true);
INSERT INTO directory_token(token, path, core_flag, relative_flag) VALUES ('__PANEL_DRAFTS__', 'wwwroot/panel_drafts/', false, true);

INSERT INTO file(directory_id, path, deprecated_major_version, deprecated_minor_version, deprecated_build) VALUES (1, 'sample.php.inc', 0, 3, 11);
INSERT INTO file(directory_id, path, deprecated_major_version, deprecated_minor_version, deprecated_build) VALUES (1, 'panel_drafts/index.tpl.php', 0, 3, 11);
INSERT INTO file(directory_id, path, deprecated_major_version, deprecated_minor_version, deprecated_build) VALUES (1, 'panel_drafts/index.php', 0, 3, 11);
