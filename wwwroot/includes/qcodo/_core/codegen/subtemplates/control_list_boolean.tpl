			$this->col<%= $objColumn->PropertyName %> = new QDataGridColumn(QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>'), '<?= ($_ITEM-><%= $objColumn->PropertyName %>) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::<%= $objTable->ClassName %>()-><%= $objColumn->PropertyName %>), 'ReverseOrderByClause' => QQ::OrderBy(QQN::<%= $objTable->ClassName %>()-><%= $objColumn->PropertyName %>, false)));