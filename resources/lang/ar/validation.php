<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	 */

	'accepted'             => 'يجب قبول :attribute',
	'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا',
	'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
	'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
	'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف',
	'alpha_dash'           => 'يجب أن لا يحتوي :attribute على حروف، أرقام ومطّات.',
	'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
	'array'                => 'يجب أن يكون :attribute ًمصفوفة',
	'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
	'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
	'between'              => [
		'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
		'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
		'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
		'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
	],
	'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false ',
	'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
	'date'                 => ':attribute ليس تاريخًا صحيحًا',
	'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
	'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
	'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام',
	'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام ',
	'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
	'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
	'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
	'exists'               => ':attribute غير موجود',
	'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
	'filled'               => ':attribute إجباري',
	'image'                => 'يجب أن يكون :attribute صورةً',
	'in'                   => ':attribute لاغٍ',
	'in_array'             => ':attribute غير موجود في :other.',
	'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا',
	'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا',
	'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
	'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
	'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
	'max'                  => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر لـ :max.',
		'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
		'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
		'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
	],
	'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
	'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
	'min'                  => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر لـ :min.',
		'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
		'string'  => 'يجب أن يكون طول نص :attribute على الأقل :min ارقام',
		'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر',
	],
	'not_in'               => ':attribute لاغٍ',
	'numeric'              => 'يجب على :attribute أن يكون رقمًا',
	'present'              => 'يجب تقديم :attribute',
	'regex'                => 'صيغة :attribute غير صحيحة',
	'required'             => ':attribute مطلوب.',
	'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
	'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
	'required_with'        => ':attribute مطلوب إذا توفّر :values.',
	'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
	'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
	'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
	'same'                 => 'يجب أن يتطابق :attribute مع :other',
	'size'                 => [
		'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size',
		'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
		'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
		'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالظبط',
	],
	'string'               => 'يجب أن يكون :attribute نصآ.',
	'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
	'unique'               => ' :attribute مُستخدم من قبل',
	'uploaded'             => 'فشل في تحميل الـ :attribute',
	'url'                  => 'صيغة الرابط :attribute غير صحيحة يجب ادخال http//:',
	'gt'                   => [
		'numeric' => 'يجب ان يكون :attribute اكبر من :value',
	],
	'lt'                   => [
		'numeric' => 'يجب ان يكون :attribute اصغر من :value',
	],
	'number_size_limit_rule'  => 'يجب ان يحتوي :attribute  علي :limit رقم/ارقام بالظبط',
	'iban_number_rule'    => 'يجب ان يبدأ رقم الايبان ب SA  و يحتوي ايضا علي 22 رقم',
	'translatable_uniqueness' => 'يجب ان لا يتكرر :attribute',
	'number_not_bigger_than_rule' => 'لا يجب ان يتجاوز :attribute :limit رقم/ارقام',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	 */

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
		'password'	=> [
			'min'		=> 'يجب ان يكون طول نص كلمه السر علي الاقل :min حروف او ارقام'
		],
		'store_license_expiration'	=> [
			'after' => 'يجب علي تاريخ انتهاء تصريح المتجر ان يكون تاريخا لاحقا لتاريخ اليوم',
		]
	],

	'values' => [
		'type'          => [
			'provider' => 'معلن',
			'2'		=> 'radiobutton',
			'3'		=> 'list',
		],
		'location_sort' => [
			'region'  => 'بالمنطقة',
			'nearest' => 'بالأقرب',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	 */

	'attributes' => [
		'case_id'               => 'رقم الحاله',
		'status'                => ' نوع ',
		'name'                  => 'الاسم',
		'username'              => 'اسم المُستخدم',
		'email'                 => 'البريد الالكتروني',
		'first_name'            => '  الاسم الاول ',
		'last_name'             => 'اسم العائلة',
		'password'              => 'كلمة السر',
		'password_confirmation' => 'تأكيد كلمة السر',
		'city'                  => 'المدينة',
		'city_id'               => 'المدينة',
		'quarter_id'            => 'لحي السكني',
		'family_number'         => 'عدد افراد الاسره ',
		'national_id_image'     => 'صوره اثبات الهويه',

		'country'              => 'الدولة',
		'address'              => 'العنوان',
		'phone'                => 'رقم الجوال',
		'mobile'               => 'الجوال',
		'age'                  => 'العمر',
		'sex'                  => 'الجنس',
		'gender'               => 'النوع',
		'day'                  => 'اليوم',
		'month'                => 'الشهر',
		'year'                 => 'السنة',
		'hour'                 => 'ساعة',
		'minute'               => 'دقيقة',
		'second'               => 'ثانية',
		'title'                => 'العنوان',
		'content'              => 'المُحتوى',
		'description'          => 'الوصف',
		'excerpt'              => 'المُلخص',
		'date'                 => 'التاريخ',
		'time'                 => 'الوقت',
		'available'            => 'مُتاح',
		'size'                 => 'الحجم',
		'payment_type'         => 'طرق الدفع',
		'category_description' => 'وصف القسم',
		'category_name'        => 'اسم القسم',
		'category_id'          => 'القسم',
		'category_icon'        => 'الايكونه',
		'image'                => 'الصوره',
		'national_id'          => 'الرقم القومي',
		'old_password'         => 'كلمه السر القديمه',
		'social_status_id'     => 'لحاله الاجتماعيه',
		'living_type_id'       => 'نوع السكن',

		'new_category_description' => 'وصف القسم',
		'new_category_name'        => 'اسم القسم',
		'new_category_icon'        => 'الايكونه',
		'image'                    => 'صورة ',
		'new_category_image'       => 'صورة القسم',
		'about_tribe'              => 'عن القبيله',
		'about_supervisor'         => 'سيرته الذاتيه',
		'supervisor_achievements'  => 'انجازاته',
		'aqsan_history'            => 'تاريخ القبيله',
		'aqsan_pens'               => 'اقلام القبيله',
		'about'                    => 'نبذه عن المدير ',
		'photo'                    => 'الصوره',
		'address_id'               => 'العنوان',
		'pay_type'                 => 'طرق الدفع',

	],
];
