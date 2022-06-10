<?php

namespace Config;

use App\Validations\AdminsRules;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validations\RegisterPromotionRules;


class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------
    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        RegisterPromotionRules::class,
        AdminsRules::class

    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];
    //--------------------------------------------------------------------
    // Your rules for validation
    //--------------------------------------------------------------------


    //--------------------------------------------------------------------
    // End-Rules for User buy static ip action
    //--------------------------------------------------------------------

    //--------------------------------------------------------------------
    public $rulesPost = [
        'post_title' => 'required',
        'post_content' => 'required',
        'post_type' => 'required',
        'post_status' => 'required',
        'lang' => 'required',
        'category_id' => 'required',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesPost_errors = [
        "post_title" => [
            "required" => "Bạn cần nhập tiêu đề",
        ],
        'post_content' => [
            'required' => "Bạn cần nhập nội dung",
        ],
        'post_type' => [
            'required' => "Bạn cần nhập kiểu bài viết",
        ],
        'category_id' => [
            'required' => "Bạn thiếu thể loại của kiểu bài viết",
        ],
        'lang' => [
            'required' => "Bạn thiếu ngôn ngữ của kiểu bài viết",
        ],
        'post_status' => [
            'required' => "Bạn cần chọn trạng thái của kiểu bài viết",
        ],
    ];

    public $rulesDynamicPage = [
        'post_title' => 'required',
        'og_url'=> 'required',
        'lang'=> 'required'
    ];

    public $rulesDynamicPage_errors = [
        "post_title" => [
            "required" => "Bạn cần nhập tiêu đề",
            ],
        "og_url" => [
            "required" => "Cần nhập đường dẫn",
        ],
        "lang" => [
            "required" => "Cần nhập ngôn ngữ",
        ],
        ];

    /* validate category */
    public $rulesCategory = [
        'post_title' => 'required',
        'lang' => 'required',
        'post_type' => 'required',
    ];


    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesCategory_errors = [
        "post_title" => [
            "required" => "Bạn cần nhập tiêu đề",
        ],
        "lang" => [
            "required" => "Bạn cần nhập ngôn ngữ",
        ],
        "post_type" => [
            "required" => "Bạn cần nhập kiểu danh mục",
        ],
    ];
    // register promotion
    public $rulesRegisterPromotion = [
        'email' => 'required|valid_email|existEmailPromotion[email]',
    ];
    public $rulesRegisterPromotion_errors = [
        "email" => [
            "required" => "Text.toastr.register_promotion.required",
            "valid_email" => "Text.toastr.register_promotion.valid_email",
            "existEmailPromotion" => "Text.toastr.register_promotion.existEmail",
        ],
    ];

    // validate service
    public $rulesService = [
        'service_name' => 'required',
        'service_price' => 'required',
        'service_introduce' => 'required',
        'service_content' => 'required',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesService_errors = [
        "service_name" => [
            "required" => "Bạn cần nhập tên dịch vụ",
        ],
        'service_price' => [
            'required' => "Bạn cần nhập giá",
        ],
        'service_introduce' => [
            'required' => "Bạn cần nhập mô tả",
        ],
        'service_content' => [
            'required' => "Bạn cần nhập các tính năng dịch vụ",
        ],
    ];


    public $rulesContactRegister = [
        'full_name' => 'required|max_length[50]',
        'email' => 'required|valid_email',
        'phone' => 'required|max_length[50]',
        'auth_code' => 'required|matches[security_code]',
        'content' => 'required',
        'roles' => 'max_length[100]',
        'company' => 'max_length[100]',
        'address' => 'max_length[200]',
    ];
    /*Validating messsages User register member*/
    public $rulesContactRegister_errors = [
        "email" => [
            "required" => "Text.contact-form.email.required",
            "validEmail" => "Text.contact-form.email.validEmail",
        ],
        'full_name' => [
            'required' => "Text.contact-form.full_name.required",
            'max_length' => "Text.contact-form.full_name.max_length",
        ],
        'auth_code' => [
            'required' => "Text.contact-form.auth_code.required",
            'matches' => "Text.contact-form.auth_code.matches",
        ],
        'content' => [
            'required' => "Text.contact-form.content.required",
            'max_length' => "Text.contact-form.content.max_length",
        ],
        'phone' => [
            'required' => "Text.contact-form.phone.required",
                'max_length' => "Text.contact-form.phone.max_length",
        ],
        'roles' => [
            'max_length' => "Text.contact-form.roles.max_length",
        ],
        'company' => [
            'max_length' => "Text.contact-form.company.max_length",
        ],
        'address' => [
            'max_length' => "Text.contact-form.address.max_length",
        ],
    ];
    public $rulesAdminLogin = [
        'admin_email' => 'required|valid_email',
        'admin_password' => 'required|verifyAdmin[admin_email,admin_password]|activeAccount[admin_email,admin_password]',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesAdminLogin_errors = [
        "admin_email" => [
            "required" => "Bạn cần nhập địa chỉ email",
            "valid_email" => "Địa chỉ email sai định dạng",

        ],
        'admin_password' => [
            'required' => "Bạn cần nhập mật khẩu",
            'verifyAdmin' => "Địa chỉ email và mật khẩu không phù hợp",
            "activeAccount" => "Tài khoản chưa được kích hoạt hoặc không tồn tại",
        ],
    ];

    public $rulesAdmin = [
        'admin_email' => 'required|valid_email|existEmailAdmin[admin_email]',
        'admin_password' => 'required',
        'admin_role'=>'required',
    ];
    public $rulesAdminEdit = [
        'admin_role'=>'required',
    ];
    public $rulesAdminEdit_errors = [
        "admin_role" => [
            'required' => "Bạn cần nhập quyền tài khoản",
        ],
        ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesAdmin_errors = [
        "admin_email" => [
            "required" => "Bạn cần nhập địa chỉ email",
            "valid_email" => "Địa chỉ email sai định dạng",
            "existEmailAdmin" => "Email đã tồn tại",

        ],
        'admin_password' => [
            'required' => "Bạn cần nhập mật khẩu",
        ],
        'admin_role' => [
            'required' => "Bạn cần nhập quyền tài khoản",
        ],
    ];


    /* validate lang */
    // validate service
    public $rulesLang = [
        'lang_key' => 'required',
        'lang_value' => 'required',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesLang_errors = [
        "lang_key" => [
            "required" => "Thiếu khóa ngôn ngữ",
        ],
        'lang_value' => [
            'required' => "Thiếu giá trị ngôn ngữ",
        ],
    ];

    public $rulesMail = [
        'mail_title' => 'required',
        'mail_content' => 'required',
        'mail_type' => 'required',
        'mail_status' => 'required',
        'mail_code' => 'required',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesMail_errors = [
        "mail_title" => [
            "required" => "Bạn cần nhập tiêu đề mail",
        ],
        'mail_content' => [
            'required' => "Bạn cần nội dung",
        ],
        'mail_type' => [
            'required' => "Bạn cần kiểu mail",
        ],
        'mail_status' => [
            'required' => "Bạn cần trạng thái mail",
        ],
        'mail_code' => [
            'required' => "Bạn cần mã mail",
        ],
    ];
    public $rulesChangePassword = [
        'admin_password' => 'required|min_length[6]',
        'admin_password_confirm' => 'required_with[admin_password]|matches[admin_password]',
    ];

    public $rulesLangCode = [
        'lang_code_key' => 'required',
        'lang_code_description' => 'required',
        'currency_symbol' => 'required',
    ];
    public $rulesLangCode_errors = [
        "lang_code_key" => [
            "required" => "Bạn cần nhập mã ngôn ngữ",
        ],
        "lang_code_description" => [
            "required" => "Bạn cần mô tả ngôn ngữ",
        ],
        "currency_symbol" => [
            "required" => "Bạn cần kí hiệu tiền tệ ngôn ngữ",
        ]
    ];
}
