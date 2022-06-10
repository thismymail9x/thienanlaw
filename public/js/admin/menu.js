//




/*
 * https://github.com/FrancescoBorzi/Nestable
 */


function edit_menu_htmlentities(str) {
    return str.replace(/[\u00A0-\u9999<>\&]/g, function (i) {
        return '&#' + i.charCodeAt(0) + ';';
    });
}

function create_ul_menu_editer(a, sub_menu) {
    if (a.length == 0) {
        return '';
    }

    //
    //console.log(a);
    var str = '';
    for (var i = 0; i < a.length; i++) {
        if (a[i].deleted * 1 !== 0) {
            continue;
        }

        //
        var a_tag = '';
        if (a[i].slug == '') {
            a_tag = a[i].name;
        } else {
            a_tag = '<a href="' + main_url + a[i].slug + '">' + a[i].name + '</a>';
        }
            console.log(a_tag,'dd');
        // nếu có menu con -> gọi luôn
        if (typeof a[i].children != 'undefined') {
            a_tag += create_ul_menu_editer(a[i].children, 'sub-menu');
        }

        //
        str += '<li>' + a_tag + '</li>';
    }

    //
    if (typeof sub_menu == 'undefined') {
        sub_menu = '';
    }
    sub_menu = jQuery.trim(sub_menu + ' cf');

    //
    return '<ul class="' + sub_menu + '">' + str + '</ul>';
}

function create_html_menu_editer(max_i) {
    if (typeof max_i != 'number') {
        max_i = 100;
    } else if (max_i < 0) {
        console.log('%c Không xác định được editer cho menu', 'color: red');
        return false;
    }

    //
    var insert_to = '';
    if (jQuery('#post_content_menu_ifr').length === 1) {
        insert_to = '#post_content_menu_ifr';
    } else if (jQuery('.cke_wysiwyg_frame').length === 1) {
        insert_to = '.cke_wysiwyg_frame';
    } else {
        setTimeout(function () {
            create_html_menu_editer(max_i - 1);
        }, 200);
        return false;
    }

    //
    var a = $('#json-output').val() || '';
    if (a != '') {
        try {
            a = JSON.parse(a);
        } catch (e) {
            WGR_show_try_catch_err(e);
            a = null;
        }
        // console.log(a,'!!!!*****');
        //
        if (a !== null) {
            var str = create_ul_menu_editer(a);
            // console.log(str,'*****');

            //
            jQuery(insert_to).contents().find('body').html(str);
        }
    }
    return true;
}

function get_json_code_menu(obj) {
    var arr = $('#json-output').val();
    $('#data_post_excerpt').val(arr);
    console.log(arr,'ttt')
    //setTimeout(function () {
    create_html_menu_editer();
    //}, 200);

    //
    if (typeof obj != 'undefined' && typeof obj.id != 'undefined') {
        // console.log(obj.id,'sss');
        setTimeout(function () {
            $('#' + obj.id + ' input[type="text"]').val('');
        }, 600);
    }

    return true;
}

var global_menu_jd = 1;

function create_html_menu_nestable(a) {
    if (a.length == 0) {
        return '';
    }

    //
    //console.log(a);
    var str = '';
    var tmp = $('.dd-tmp-list').html() || '';
    if (tmp == '') {
        console.log('%c dd-tmp-list not found!', 'color: red;');
        return false;
    }

    //
    for (var i = 0; i < a.length; i++) {
        //console.log(a[i]);
        if (a[i].deleted * 1 !== 0) {
            continue;
        }

        //
        var htm = tmp;
        a[i]['id'] = global_menu_jd;
        global_menu_jd++;
        for (var x in a[i]) {
            //console.log(a[i]);
            if (typeof a[i].name == 'undefined') {
                continue;
            }
            var newText = JSON.parse(JSON.stringify(a[i]));
            //console.log(newText);
            //newText.newText = newText.name;

            // thay " thành &quot; để đỡ lỗi HTML
            for (var j = 0; j < 10; j++) {
                htm = htm.replace('%newText%', newText.name);
                a[i].name = a[i].name.replace('"', '&quot;');
            }
            //console.log(a[i]);

            //
            for (var j = 0; j < 10; j++) {
                htm = htm.replace('%' + x + '%', a[i][x]);
            }
        }

        // nếu có menu con -> gọi luôn
        var child_htm = '';
        if (typeof a[i].children != 'undefined') {
            child_htm = create_html_menu_nestable(a[i].children);
        }
        htm = htm.replace('%child_htm%', child_htm);
        //console.log(htm);

        //
        str += htm;
    }

    //
    return '<ol class="dd-list">' + str + '</ol>';
}

/*
 *
 */

//$(document).ready(function () {
//$('.hide-if-edit-menu').hide();

(function () {
    // tạo html cho việc chỉnh sửa menu
    var a = $('#data_post_excerpt').val() || '';

    if (a != '') {
        try {
            a = JSON.parse(a);
            //console.log(a);
        } catch (e) {
            WGR_show_try_catch_err(e);
            a = null;
        }
        //
        if (a !== null) {
            var str = create_html_menu_nestable(a);
            //console.log(str);

            //
            jQuery('.dd.nestable').html(str).show();
        }
    }
})();

//
//create_html_menu_editer();
//});

$('#quick_add_menu').change(function () {
    var v = $('#quick_add_menu').val() || '';

    if (v != '') {
        var base_url = $('base ').attr('href') || '';
        if (base_url != '') {
            v = v.replace(base_url, './');
        }

        //
        $('#addInputName').val($('#quick_add_menu option:selected').text());
    } else {
        $('#addInputName').val(v);
    }
    $('#addInputSlug').val(v);
    $('#addInputName').focus();
});


// =====================
/*jslint browser: true, devel: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $ */

/*************** General ***************/

var updateOutput = function (e) {
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        if (output) {
            output.val(window.JSON.stringify(list.nestable('serialize')));
        }
    } else {
        alert('JSON browser support required for this page.');
    }
};

var nestableList = $(".dd.nestable > .dd-list");

/***************************************/


/*************** Delete ***************/

var deleteFromMenuHelper = function (target) {
    if (target.data('new') == 1) {
        // if it's not yet saved in the database, just remove it from DOM
        target.fadeOut(function () {
            target.remove();
            updateOutput($('.dd.nestable').data('output', $('#json-output')));
        });
    } else {
        // otherwise hide and mark it for deletion
        target.appendTo(nestableList); // if children, move to the top level
        target.data('deleted', '1');
        target.fadeOut();
    }
};

var deleteFromMenu = function () {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var result = confirm("Delete " + target.data('name') + " and all its subitems ?");
    if (!result) {
        return;
    }

    // Remove children (if any)
    target.find("li").each(function () {
        deleteFromMenuHelper($(this));
    });

    // Remove parent
    deleteFromMenuHelper(target);

    // update JSON
    updateOutput($('.dd.nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Edit ***************/

var menuEditor = $("#menu-editor");
var editButton = $("#editButton");
var editInputName = $("#editInputName");
var editInputSlug = $("#editInputSlug");
var currentEditName = $("#currentEditName");

// Prepares and shows the Edit Form
var prepareEdit = function () {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    editInputName.val(target.data("name"));
    editInputSlug.val(target.data("slug"));
    currentEditName.html(target.data("name"));
    editButton.data("owner-id", target.data("id"));

    console.log("[INFO] Editing Menu Item " + editButton.data("owner-id"));

    menuEditor.fadeIn();
};

// Edits the Menu item and hides the Edit Form
var editMenuItem = function () {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var newName = editInputName.val();
    var newSlug = editInputSlug.val();

    target.data("name", newName);
    target.data("slug", newSlug);

    target.find("> .dd-handle").html(newName);
    console.log('99999')
    menuEditor.fadeOut();

    // update JSON
    updateOutput($('.dd.nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Add ***************/

var newIdCount = 1;

var addToMenu = function () {
    var newName = $("#addInputName").val();
    var newSlug = $("#addInputSlug").val();
    var newId = 'new-' + newIdCount;
    nestableList.append(
        '<li class="dd-item" '
        + 'data-id="' + newId + '" '
        + 'data-name="' + newName + '" '
        + 'data-slug="' + newSlug + '" '
        + 'data-new="1" '
        + 'data-deleted="0">'
        + '<div class="dd-handle">' + newName + '</div> '
        + '<span class="button-delete btn btn-default btn-xs pull-right" '
        + 'data-owner-id="' + newId + '"> '
        + '<i class="fa far fa-times-circle" aria-hidden="true"></i> '
        + '</span>'
        + '<span class="button-edit btn btn-default btn-xs pull-right" '
        + 'data-owner-id="' + newId + '">'
        + '<i class="fas fa-pencil-alt" aria-hidden="true"></i>'
        + '</span>'
        + '</li>'
    );

    newIdCount++;

    // update JSON
    updateOutput($('.dd.nestable').data('output', $('#json-output')));

    // set events
    $(".dd.nestable .button-delete").on("click", deleteFromMenu);
    $(".dd.nestable .button-edit").on("click", prepareEdit);
};


/***************************************/




// if (current_post_type == page_post_type) {
//     WGR_load_textediter('#data_post_excerpt');
// }
function WGR_load_textediter(for_id, ops) {
    if (typeof ops == 'undefined') {
        ops = {};
    }
    if (typeof ops['height'] == 'undefined') {
        ops['height'] = 250;
    }
    if (typeof ops['plugins'] == 'undefined') {
        ops['plugins'] = [
            'advlist autolink lists link image imagetools charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ];
    }
    if (typeof ops['toolbar'] == 'undefined') {
        ops['toolbar'] = 'undo redo | formatselect | '
            + 'bold italic backcolor | alignleft aligncenter '
            + 'alignright alignjustify | bullist numlist outdent indent | image | '
            + 'link table | '
            + 'removeformat code | help';
    }

    //
    tinymce.init({
        selector: 'textarea' + for_id,
        height: ops['height'],
        //menubar: false,
        plugins: ops['plugins'],
        //a11y_advanced_options: true,
        //
        image_title: true,
        image_caption: true,
        image_advtab: true,
        //imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
        //images_upload_url: 'admin/uploads?post_type=file_upload&quick_upload=1&insert_to=Resolution&add_img_tag=1&img_size=&input_type=textediter',
        // rel cho thẻ A
        rel_list: [{
            title: 'None',
            value: ''
        }, {
            title: 'No Referrer',
            value: 'noreferrer'
        }, {
            title: 'No Follow',
            value: 'nofollow'
            /*
        }, {
            title: 'No Opener',
            value: 'noopener'
            */
        }, {
            title: 'External Link',
            value: 'external'
        }],
        //
        toolbar: ops['toolbar'],
        setup: function (ed) {
            // sự kiện khi khi nhấp đúp chuột
            ed.on('DblClick', function (e) {
                //console.log(e.target.nodeName);
                // nếu là hình ảnh -> mở hộp thoại sửa ảnh
                if (e.target.nodeName == 'IMG') {
                    tinymce.activeEditor.execCommand('mceImage');
                }
                // nếu là URL -> mở hộp chỉnh sửa URL
                else if (e.target.nodeName == 'A') {
                    tinymce.activeEditor.execCommand('mceLink');
                }
            }).on('Click', function (e) {
                console.log(e.target.nodeName);
                // nếu là hình ảnh -> gán là đang thao tác với ảnh
                if (e.target.nodeName == 'IMG') {
                    check_and_add_btn_upload = true;
                } else {
                    check_and_add_btn_upload = false;
                }
            });
        },
    });

}

/*
 * chức năng nhúng dữ liệu mẫu vào editer
 */
$('.get-table-img-tmp td').html($.trim($('.get-figure-img-tmp').html() || ''));

//
$('.click-set-tinymce-tmp').click(function () {
    var a = $(this).attr('data-tmp') || '';
    if (a != '') {
        var b = $('.' + a).html() || '';
        if (b != '') {
            b = $.trim(b);
            tinymce.get('Resolution').insertContent(b);
        } else {
            console.log('%c class ' + a + ' data-tmp not found!', 'color: red;');
        }
    } else {
        console.log('%c data-tmp not found!', 'color: red;');
    }
});
function WGR_show_try_catch_err(e) {
    return 'name: ' + e.name + '; line: ' + (e.lineNumber || e.line) + '; script: ' + (e.fileName || e.sourceURL || e.script) + '; stack: ' + (e.stackTrace || e.stack) + '; message: ' + e.message;
}
$(function () {

    // output initial serialised data
    updateOutput($('.dd.nestable').data('output', $('#json-output')));

    // set onclick events
    editButton.on("click", editMenuItem);

    $(".dd.nestable .button-delete").on("click", deleteFromMenu);

    $(".dd.nestable .button-edit").on("click", prepareEdit);

    $("#menu-editor").submit(function (e) {
        e.preventDefault();
    });
    //
    $("#menu-add").submit(function (e) {
        e.preventDefault();
        //console.log('ddd')
        addToMenu();
    });
});
$('.menu-edit-input input[type="text"]').change(function () {
    $(this).val($.trim($(this).val()));
});

//
$('.dd.nestable').nestable({
    maxDepth: 3
}).on('change', updateOutput);

$('.dd').on('change', function () {
    get_json_code_menu();

});

$('#addButton, #editButton, .btn.btn-success').click(function () {
    get_json_code_menu();
});



