<?php

return [

	'profile' =>'بروفايل',
	'go' => 'إذهب!',
	'are_you_sure' => 'هل انت متأكد',
	'edit' => 'تعديل',
	'update' => 'تحديث',
	'done' => 'تم',
	'back' => 'الخلف',


    'left_side_bar'=>[
		'calendar'=>'التقويم',
		'ledgers'=>'الحسابات',
		'dashboard'=>[
		    'title'=>'لوحة التحكم',
			'admin'=>'مدير',
			'doctor'=>'طبيب',
			'reception'=>'إستقبال',
			'accountant'=>'محاسب'
		],
		'user_managment'=>[
		    'title'=>'ادارة المستخدمين',
			'users'=>'مستخدمون',
			'roles'=>'اللوائح'
		],
		'medical'=>[
		    'title'=>'الإدارة الطبية',
			'patients'=>'المرضي',
			'drugs'=>'الأدوية',
			'insurance'=>'التأمين',
			'procedures'=>'خطوات العمل',
			'lab'=>'معامل',
		],
		'store'=>[
		    'title'=>'المخزن',
			'store'=>'المخزن',
			'products'=>'الخامات'
		],
		'setting'=>[
		    'title'=>'الإعدادات',
			'priceLists'=>'قائمة الأسعار',
			'suppliers'=>'الموردين',
			'banks'=>'البنوك',
			'allergies'=>'الحساسيات',
			'diseases'=>'الأمراض',

		],
	],

	'users' => [
		'title' => 'المستخدمون',
		'all_users' => 'قائمة المستخدمون',
		'create'=> 'إنشاء',
		'edit_user'=> 'تعديل المستخدم',
		'edit_users'=> 'تعديل المستخدمين',
		'add_user'=> 'إضافة مستخدم',
		'personal_info' => 'البيانات الشخصية',
		'roles' => 'اللوائح',
		'permissions' => 'الإختصاصات',
		'phone' => 'الهاتف',
		'phones' => 'الهواتف',

		'fields' => [
			'name' => 'الإسم الثلاثي',
			'username' => 'إسم المستخدم',
			'email' => 'الإيميل',
			'password' => 'كلمة المرور',
			'password_confirmation' => 'تأكيد كلمة المرور',
			'role' => 'اللائحة',
			'submit' => 'إضافة المستخدم'
		],
		'table'=>[
			'id' => 'المعرف',
			'name'=>'الإسم',
			'action' => 'إختيارات'

		]
	],

	'suppliers' => [
		'title' => 'الموردين',
		'all_suppliers' => 'قائمة الموردين',
		'create'=> 'إنشاء مورد',
		'edit_supplier'=> 'تعديل مورد',
		'edit_suppliers'=> 'تعديل الموردين',
		'add_supplier'=> 'إضافة مورد',
		'personal_info' => 'بيانات شخصية',
		'phone' => 'الهاتف',
		'phones' => 'هواتف',

		'fields' => [
			'name' => 'الإسم الثلاثي',
			'address' => 'العنوان',
			'submit' => 'إضافة مورد'
		],
		'table'=>[
			'id' => 'معرف',
			'name'=>'الإسم',
			'address' => 'العنوان'

		]
	],

	'doctors' => [
		'title' => 'الأطباء',
		'all_doctors' => 'الأطباء',
		'create'=> 'إنشاء طبيب',
		'edit_doctor'=> 'Edit Doctor',
		'edit_doctors'=> 'Edit Doctors',
		'add_doctor'=> 'Add Doctor',
		'personal_info' => 'Personal Info',
		'roles' => 'Roles',
		'permissions' => 'Permissions',
		'phone' => 'Phone',
		'phones' => 'Phones',

		'fields' => [
			'position' => 'Position',
			'address' => 'Address',
			'medical_id' => 'Medical ID',
			'speciality' => 'Speciality',
			'submit' => 'Add Doctor'
		],
		'table'=>[
			'id' => 'ID',
			'name'=>'Name',
			'action' => 'Action'

		]
	],

	'patients' => [
		'title' => 'المرضى',
		'all_patients' => 'المرضى',
		'create'=> 'إنشاء مريض',
		'edit'=> 'تعديل ',
		'edit_patient'=> 'تعديل مريض',
		'edit_patients'=> 'تعديلات المرضي',
		'add_patient'=> 'إضافة مريض',
        'personal_info' => 'البيانات الشخصية',

		'fields' => [
			'name' => 'الإسم ثلاثي',
			'email' => 'الإيميل',
			'submit' => 'إضافة المريض',
			'address'=>'العنوان',
			'gender' =>'النوع',
			'male' => 'ذكر',
			'female' => 'إنثى',
			'insurance_id' => 'رقم كارت التأمين',
		],
		'table'=>[
			'id' => 'معرف',
			'name'=>'الإسم',
			'phone'=>'الهاتف',
			'email'=>'الإيميل',
			'address'=>'العنوان',
			'action' => 'الاختيارات'

		]
	],

	'drugs' => [
		'title' => 'الأدوية',
		'all_drugs' => 'الأدوية',
		'create'=> 'Create New Drug',
		'edit'=> 'Edit',
		'edit_drug'=> 'Edit Drug',
		'edit_drugs'=> 'Edit Drugs',
		'add_drug'=> 'Add Drug',

		'fields' => [
			'name' => 'Trade Name',
			'scientific_name' => 'Scientific Name',
			'form' => 'Form',
			'use'=>'Use',
			'dose' =>'Dose',
			'concentration' => 'Concentration',
			'price' => 'Price',
			'indications' => 'Indications',
			'precautions' => 'Precautions',
			'pamphlet' => 'Pamphlet',
			'company' => 'Company'
		],
		'table'=>[
			'id' => 'ID',
			'name' => 'Trade Name',
			'scientific_name' => 'Scientific Name',
			'form' => 'Form',
			'use'=>'Use',
			'dose' =>'Dose',
			'concentration' => 'Concentration',
			'price' => 'Price',
			'indications' => 'Indications',
			'precautions' => 'Precautions',
			'pamphlet' => 'Pamphlet',
			'company' => 'Company',
			'action' => "Action",

		]
	],

	'products' => [
		'title' => 'Products',
		'all_products' => 'All Products',
		'create'=> 'Create New Product',
		'edit'=> 'Edit',
		'edit_product'=> 'Edit Product',
		'edit_products'=> 'Edit Products',
		'add_product'=> 'Add Product',

		'fields' => [
			'name' => 'Name',
			'form' => 'Form',
			'uses'=>'Uses',
			'bakage'=>'Bakage',
			'catigories'=>'Catigory',
			'unit' =>'Unit',
			'amount' =>'Units/Pakage',
			'amount_placeholder' =>'How many units does the pakage contain',
			'description' => 'Description',
			'company' => 'Company'
		],
		'table'=>[
			'id' => 'ID',
			'name' => 'Name',
			'form' => 'Form',
			'uses'=>'Uses',
			'catigory'=>'Catigory',
			'amount' =>'Units/Pakage',
			'unit' =>'Unit',
			'description' => 'Description',
			'company' => 'Company'
		]
	],

	'labs' => [
		'title' => 'Labs',
		'all_labs' => 'All Labs',
		'create'=> 'Create New Lab',
		'edit'=> 'Edit',
		'edit_lab'=> 'Edit Lab',
		'edit_labs'=> 'Edit Labs',
		'add_lab'=> 'Add Lab',

		'fields' => [
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'price_list_id' => 'Price List',
		],
		'table'=>[
			'id' => 'ID',
			'name' => 'Name',
			'address' => 'Address',
			'price_list_id' => 'Price List',
			'action' => "Action",

		]
	],

	'insuranceCards' => [
		'title' => 'insurance Cards',
		'all_insuranceCards' => 'All Insurance Cards',
		'create'=> 'Create New Insurance Card',
		'edit_insuranceCard'=> 'Edit Insurance Card',
		'edit_insuranceCards'=> 'Edit Insurance Cards',
		'add_insuranceCard'=> 'Add Insurance Card',

		'fields' => [
			'card_id' => 'Card Number',
			'insurance_no' => 'Insurance No',
			'patient_id' => 'Patient',
			'expiry' => 'Expiry',
			'network' => 'Network',
			'catigory' => 'Catigory',
			'dental' => 'Dental',
			'co_ins' => 'Co-Ins',
			'policy_holder' => 'Policy Holder',
			'effective' => 'Effective',
			'deductible' => 'Deductible',
			'job_company' => 'Job Company',
			'image' => 'Card Image',
			'insurance_company_id' => 'Insurance Company',
			'submit' => 'Add Insurance Card',
		],
		'table'=>[
			'id' => 'ID',
			'name'=>'Name',
			'action' => 'Action'
		]
	],

	'services' => [
		'title' => 'Services',
		'all_services' => 'All Services',
		'create'=> 'Create New Service',
		'edit_service'=> 'Edit Service',
		'edit_services'=> 'Edit Services',
		'add_service'=> 'Add Service',
		'edit'=> 'Add Service',

		'fields' => [
		'name' => 'Service Name',
		'description'=> 'Service description',
		'submit' => 'Add service'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'signs' => [
		'title' => 'Signs',
		'all_signs' => 'All Signs',
		'create'=> 'Create New Sign',
		'edit_sign'=> 'Edit Sign',
		'edit_signs'=> 'Edit Signs',
		'add_sign'=> 'Add Sign',
		'edit'=> 'Add Sign',

		'fields' => [
		'name' => 'Sign Name',
		'description'=> 'Sign description',
		'submit' => 'Add Sign'
		],

		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'procedures' => [
		'title' => 'Procedures',
		'all_procedures' => 'All Procedures',
		'create'=> 'Create New Procedure',
		'edit_procedure'=> 'Edit Procedure',
		'edit_procedures'=> 'Edit Procedures',
		'add_procedure'=> 'Add Procedure',
		'edit'=> 'Add Procedure',

		'fields' => [
		'name' => 'Procedure Name',
		'description'=> 'Procedure description',
		'submit' => 'Add Procedure'
		],

		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'symptoms' => [
		'title' => 'Symptoms',
		'all_symptoms' => 'All Symptoms',
		'create'=> 'Create New Symptom',
		'edit_symptom'=> 'Edit Symptom',
		'edit_symptoms'=> 'Edit Symptoms',
		'add_symptom'=> 'Add Symptom',
		'edit'=> 'Add Symptom',

		'fields' => [
		'name' => 'Symptom Name',
		'description'=> 'Symptom description',
		'submit' => 'Add Symptom'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],
	'diseases' => [
		'title' => 'Diseases',
		'all_diseases' => 'All Diseases',
		'create'=> 'Create New Disease',
		'edit_disease'=> 'Edit Disease',
		'edit_diseases'=> 'Edit Diseases',
		'add_disease'=> 'Add Disease',
		'edit'=> 'Edit',

		'fields' => [
		'name' => 'Disease Name',
		'catigory'=> 'Catigory',
		'type'=> 'Type',
		'aetiology'=> 'Aetiology',
		'conclusion'=> 'Conclusion',
		'clinical_features'=> ' Clinical Features',
		'histopathologic_features'=> 'Histopathologic Features',
		'treatment'=> 'Treatment',
		'diffrential_diagnosis'=> 'Diffrential Diagnosis',
		'submit' => 'Add Disease',
		'definition' => 'Definition'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'allergies' => [
		'title' => 'Allergies',
		'all_allergies' => 'All Allergies',
		'create'=> 'Create New Allergy',
		'edit_allergy'=> 'Edit Allergy',
		'edit_allergies'=> 'Edit Allergies',
		'add_allergy'=> 'Add Allergy',
		'edit'=> 'Add Allergy',

		'fields' => [
		'name' => 'Allergy Name',
		'description'=> 'Allergy description',
		'submit' => 'Add Allergy'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'priceLists' => [
		'title' => 'Price Lists',
		'all_priceLists' => 'All Price Lists',
		'create'=> 'Create New Price List',
		'edit_priceList'=> 'Edit Price List',
		'edit_priceLists'=> 'Edit Price Lists',
		'add_priceList'=> 'Add Price List',
		'edit'=> 'Add Price List',
		'price_list'=> 'Price List',

		'fields' => [
		'name' => 'Price List Name',
		'description'=> 'Price List description',
		'submit' => 'Add Price List'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'companies' => [
		'title' => 'companies',
		'all_companies' => 'All Companies',
		'create'=> 'Create New Company',
		'edit_company'=> 'Edit Company',
		'edit_companies'=> 'Edit Companies',
		'add_company'=> 'Add Company',
		'edit'=> 'Add Company',

		'fields' => [
		'name' => 'Company Name',
		'address'=> 'Address',
		'email' => 'Email',
		'submit' => 'Add Company'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

	'roles' => [
		'title' => 'Roles',
		'all_roles' => 'All Roles',
		'create'=> 'Create New Role',
		'edit_role'=> 'Edit Role',
		'edit_roles'=> 'Edit Roles',
		'add_role'=> 'Add Role',

		'fields' => [
		'name' => 'Role Name',
		'permissions'=> 'Permissions',
		'submit' => 'Add Role'
		],
		'table' => [
			'id' => 'ID',
			'name' => 'Name',
			'action' => "Action"
		]
	],

'permissions' => [
		'title' => 'Permissions',
		'all_permissions' => 'All Permissions',
		'create'=> 'Create New Permission',
		'edit_permission'=> 'Edit Permission',
		'edit_permissions'=> 'Edit Permissions',
		'add_permission'=> 'Add Permission',
		'permissions_from_roles' => 'Permissions From Roles',
		'direct_permissions' => "Direct Permissions",

		'fields' => [
		'name' => 'Permission Name',
		'submit' => 'Add Permission'
		],

		'table' =>[
			'id' => 'ID',
			'name' =>'Name',
			'action' => 'Action'
		]

	],



];
