<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'فیلد :attribute باید پذیرفته شده باشد.',
    'accepted_if' => 'فیلد :attribute باید پذیرفته شده باشد وقتی :other برابر با :value است.',
    'active_url' => 'فیلد :attribute باید یک URL معتبر باشد.',
    'after' => 'فیلد :attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal' => 'فیلد :attribute باید تاریخی بعد از یا برابر با :date باشد.',
    'alpha' => 'فیلد :attribute باید فقط شامل حروف باشد.',
    'alpha_dash' => 'فیلد :attribute باید فقط شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num' => 'فیلد :attribute باید فقط شامل حروف و اعداد باشد.',
    'array' => 'فیلد :attribute باید یک آرایه باشد.',
    'ascii' => 'فیلد :attribute باید فقط شامل کاراکترهای تک بایتی و نمادها باشد.',
    'before' => 'فیلد :attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal' => 'فیلد :attribute باید تاریخی قبل از یا برابر با :date باشد.',
    'between' => [
        'array' => 'فیلد :attribute باید بین :min و :max آیتم داشته باشد.',
        'file' => 'فیلد :attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بین :min و :max باشد.',
        'string' => 'فیلد :attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'فیلد :attribute باید درست یا نادرست باشد.',
    'can' => 'فیلد :attribute حاوی مقدار غیرمجاز است.',
    'confirmed' => 'تأیید فیلد :attribute مطابقت ندارد.',
    'contains' => 'فیلد :attribute فاقد یک مقدار مورد نیاز است.',
    'current_password' => 'رمز عبور نادرست است.',
    'date' => 'فیلد :attribute باید یک تاریخ معتبر باشد.',
    'date_equals' => 'فیلد :attribute باید تاریخی برابر با :date باشد.',
    'date_format' => 'فیلد :attribute باید با فرمت :format مطابقت داشته باشد.',
    'decimal' => 'فیلد :attribute باید دارای :decimal رقم اعشاری باشد.',
    'declined' => 'فیلد :attribute باید رد شده باشد.',
    'declined_if' => 'فیلد :attribute باید رد شده باشد وقتی :other برابر با :value است.',
    'different' => 'فیلد :attribute و :other باید متفاوت باشند.',
    'digits' => 'فیلد :attribute باید :digits رقم باشد.',
    'digits_between' => 'فیلد :attribute باید بین :min و :max رقم باشد.',
    'dimensions' => 'فیلد :attribute ابعاد تصویر نامعتبر دارد.',
    'distinct' => 'فیلد :attribute دارای مقدار تکراری است.',
    'doesnt_end_with' => 'فیلد :attribute نباید با یکی از مقادیر زیر تمام شود: :values.',
    'doesnt_start_with' => 'فیلد :attribute نباید با یکی از مقادیر زیر شروع شود: :values.',
    'email' => 'فیلد :attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => 'فیلد :attribute باید با یکی از مقادیر زیر تمام شود: :values.',
    'enum' => 'مقدار انتخاب شده :attribute معتبر نیست.',
    'exists' => 'مقدار انتخاب شده :attribute معتبر نیست.',
    'extensions' => 'فیلد :attribute باید یکی از پسوندهای زیر را داشته باشد: :values.',
    'file' => 'فیلد :attribute باید یک فایل باشد.',
    'filled' => 'فیلد :attribute باید دارای مقدار باشد.',
    'gt' => [
        'array' => 'فیلد :attribute باید بیشتر از :value آیتم داشته باشد.',
        'file' => 'فیلد :attribute باید بزرگتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر از :value باشد.',
        'string' => 'فیلد :attribute باید بیشتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => 'فیلد :attribute باید دارای :value آیتم یا بیشتر باشد.',
        'file' => 'فیلد :attribute باید بزرگتر از یا برابر با :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر از یا برابر با :value باشد.',
        'string' => 'فیلد :attribute باید بیشتر از یا برابر با :value کاراکتر باشد.',
    ],
    'hex_color' => 'فیلد :attribute باید یک رنگ هگزادسیمال معتبر باشد.',
    'image' => 'فیلد :attribute باید یک تصویر باشد.',
    'in' => 'مقدار انتخاب شده :attribute معتبر نیست.',
    'in_array' => 'فیلد :attribute باید در :other وجود داشته باشد.',
    'integer' => 'فیلد :attribute باید یک عدد صحیح باشد.',
    'ip' => 'فیلد :attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => 'فیلد :attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => 'فیلد :attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => 'فیلد :attribute باید یک رشته JSON معتبر باشد.',
    'list' => 'فیلد :attribute باید یک لیست باشد.',
    'lowercase' => 'فیلد :attribute باید به حروف کوچک نوشته شده باشد.',
    'lt' => [
        'array' => 'فیلد :attribute باید کمتر از :value آیتم داشته باشد.',
        'file' => 'فیلد :attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر از :value باشد.',
        'string' => 'فیلد :attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => 'فیلد :attribute نباید بیشتر از :value آیتم داشته باشد.',
        'file' => 'فیلد :attribute باید کمتر از یا برابر با :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر از یا برابر با :value باشد.',
        'string' => 'فیلد :attribute باید کمتر از یا برابر با :value کاراکتر باشد.',
    ],
    'mac_address' => 'فیلد :attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => 'فیلد :attribute نباید بیشتر از :max آیتم داشته باشد.',
        'file' => 'فیلد :attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute نباید بزرگتر از :max باشد.',
        'string' => 'فیلد :attribute نباید بزرگتر از :max کاراکتر باشد.',
    ],
    'max_digits' => 'فیلد :attribute نباید بیشتر از :max رقم داشته باشد.',
    'mimes' => 'فیلد :attribute باید فایلی از نوع: :values باشد.',
    'mimetypes' => 'فیلد :attribute باید فایلی از نوع: :values باشد.',
    'min' => [
        'array' => 'فیلد :attribute باید حداقل :min آیتم داشته باشد.',
        'file' => 'فیلد :attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید حداقل :min باشد.',
        'string' => 'فیلد :attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => 'فیلد :attribute باید حداقل :min رقم داشته باشد.',
    'missing' => 'فیلد :attribute باید وجود نداشته باشد.',
    'missing_if' => 'فیلد :attribute باید وجود نداشته باشد وقتی :other برابر با :value است.',
    'missing_unless' => 'فیلد :attribute باید وجود نداشته باشد مگر اینکه :other در :values باشد.',
    'missing_with' => 'فیلد :attribute باید وجود نداشته باشد وقتی :values وجود دارد.',
    'missing_with_all' => 'فیلد :attribute باید وجود نداشته باشد وقتی :values وجود دارد.',
    'multiple_of' => 'فیلد :attribute باید مضربی از :value باشد.',
    'not_in' => 'مقدار انتخاب شده :attribute معتبر نیست.',
    'not_regex' => 'فرمت فیلد :attribute نامعتبر است.',
    'numeric' => 'فیلد :attribute باید یک عدد باشد.',
    'password' => [
        'letters' => 'فیلد :attribute باید حداقل یک حرف داشته باشد.',
        'mixed' => 'فیلد :attribute باید حداقل یک حرف بزرگ و یک حرف کوچک داشته باشد.',
        'numbers' => 'فیلد :attribute باید حداقل یک عدد داشته باشد.',
        'symbols' => 'فیلد :attribute باید حداقل یک نماد داشته باشد.',
        'uncompromised' => 'فیلد :attribute در یک نشت داده‌ها ظاهر شده است. لطفاً یک :attribute متفاوت انتخاب کنید.',
    ],
    'present' => 'فیلد :attribute باید حاضر باشد.',
    'present_if' => 'فیلد :attribute باید حاضر باشد وقتی :other برابر با :value است.',
    'present_unless' => 'فیلد :attribute باید حاضر باشد مگر اینکه :other در :value باشد.',
    'present_with' => 'فیلد :attribute باید حاضر باشد وقتی :values وجود دارد.',
    'present_with_all' => 'فیلد :attribute باید حاضر باشد وقتی :values وجود دارد.',
    'prohibited' => 'فیلد :attribute ممنوع است.',
    'prohibited_if' => 'فیلد :attribute ممنوع است وقتی :other برابر با :value است.',
    'prohibited_unless' => 'فیلد :attribute ممنوع است مگر اینکه :other در :values باشد.',
    'prohibits' => 'فیلد :attribute از حضور :other جلوگیری می‌کند.',
    'regex' => 'فرمت فیلد :attribute نامعتبر است.',
    'required' => 'فیلد :attribute الزامی است.',
    'required_array_keys' => 'فیلد :attribute باید ورودی‌هایی برای: :values داشته باشد.',
    'required_if' => 'فیلد :attribute الزامی است وقتی :other برابر با :value است.',
    'required_if_accepted' => 'فیلد :attribute الزامی است وقتی :other پذیرفته شده است.',
    'required_if_declined' => 'فیلد :attribute الزامی است وقتی :other رد شده است.',
    'required_unless' => 'فیلد :attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with' => 'فیلد :attribute الزامی است وقتی :values وجود دارد.',
    'required_with_all' => 'فیلد :attribute الزامی است وقتی :values وجود دارد.',
    'required_without' => 'فیلد :attribute الزامی است وقتی :values وجود ندارد.',
    'required_without_all' => 'فیلد :attribute الزامی است وقتی هیچ‌یک از :values وجود ندارد.',
    'same' => 'فیلد :attribute باید با :other مطابقت داشته باشد.',
    'size' => [
        'array' => 'فیلد :attribute باید شامل :size آیتم باشد.',
        'file' => 'فیلد :attribute باید :size کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید :size باشد.',
        'string' => 'فیلد :attribute باید :size کاراکتر باشد.',
    ],
    'starts_with' => 'فیلد :attribute باید با یکی از مقادیر زیر شروع شود: :values.',
    'string' => 'فیلد :attribute باید یک رشته باشد.',
    'timezone' => 'فیلد :attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => 'فیلد :attribute قبلاً گرفته شده است.',
    'uploaded' => 'بارگذاری فیلد :attribute ناموفق بود.',
    'uppercase' => 'فیلد :attribute باید به حروف بزرگ نوشته شده باشد.',
    'url' => 'فیلد :attribute باید یک URL معتبر باشد.',
    'ulid' => 'فیلد :attribute باید یک ULID معتبر باشد.',
    'uuid' => 'فیلد :attribute باید یک UUID معتبر باشد.',
    'verification_code_invalid' => 'کد تأیید نامعتبر است.',
    'mobile_not_found' => 'شماره موبایل پیدا نشد.',
    'password_invalid' => 'رمز عبور نادرست است.',
    'verification_code' => 'کد تایید الزامی است.',

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
            'rule-name' => 'پیام سفارشی',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
