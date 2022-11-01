// replace vnese
function replace_vn(str) {
    if (str == null) {
        return '';
    }
    str = str.toLowerCase();
    str = str.replace(/\u00e0|\u00e1|\u1ea1|\u1ea3|\u00e3|\u00e2|\u1ea7|\u1ea5|\u1ead|\u1ea9|\u1eab|\u0103|\u1eb1|\u1eaf|\u1eb7|\u1eb3|\u1eb5/g, "a");
    str = str.replace(/\u00e8|\u00e9|\u1eb9|\u1ebb|\u1ebd|\u00ea|\u1ec1|\u1ebf|\u1ec7|\u1ec3|\u1ec5/g, "e");
    str = str.replace(/\u00ec|\u00ed|\u1ecb|\u1ec9|\u0129/g, "i");
    str = str.replace(/\u00f2|\u00f3|\u1ecd|\u1ecf|\u00f5|\u00f4|\u1ed3|\u1ed1|\u1ed9|\u1ed5|\u1ed7|\u01a1|\u1edd|\u1edb|\u1ee3|\u1edf|\u1ee1/g, "o");
    str = str.replace(/\u00f9|\u00fa|\u1ee5|\u1ee7|\u0169|\u01b0|\u1eeb|\u1ee9|\u1ef1|\u1eed|\u1eef/g, "u");
    str = str.replace(/\u1ef3|\u00fd|\u1ef5|\u1ef7|\u1ef9/g, "y");
    str = str.replace(/\u0111/g, "d");
    return str;
}

// add - to string
function replace_word(str) {
    str = replace_vn(str);
    str = str.replace(/\s/g, "-");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|$|_/g, "");
    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");
    for (var i = 0; i < 5; i++) {
        str = str.replace(/--/g, '-');
    }
    str = (function (s) {
        var str = '',
            re = /^\w+$/,
            t = '';
        for (var i = 0; i < s.length; i++) {
            t = s.substr(i, 1);
            if (t == '-' || t == '+' || re.test(t) == true) {
                str += t;
            }
        }
        return str;
    })(str);
    return str;
}

// tinny upload file and save content

tinymce.init({
    selector: '#post_content, .mail_content, #post_content_menu',
    width: '100%',
    height: 600,
    content_css: "/public/css/home/section-footer-top.css," +
        "/public/css/home/footer.css," +
        "/public/css/home/feature.css," +
        "/public/plugins/bootstrap4.5/css/bootstrap.min.css," +
        "/public/css/home/our-vpn.css," +
        "/public/css/home/our-story.css," +
        "/public/css/home/contact.css," +
        "/public/css/home/home.css," +
        "/public/css/home/price.css," +
        "/public/css/home/global.css," +
        "/public/css/home/section-footer-top.css," +
        "/public/css/home/contact.css," +
        "/public/css/home/policy-security.css" +
        "/public/css/home/thienan.css",
    toolbar: [
        'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | imageupload insertfile image media template link codesample | ltr rtl code',
    ],
    plugins: 'image code link print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',

    menu: {
        file: {
            title: 'File',
            items: 'newdocument restoredraft | preview | print'
        },
        edit: {
            title: 'Edit',
            items: 'undo redo | cut copy paste | selectall | searchreplace'
        },
        view: {
            title: 'View',
            items: 'code | visualaid visualchars visualblocks | preview fullscreen'
        },
        insert: {
            title: 'Insert',
            items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime'
        },
        format: {
            title: 'Format',
            items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
        },
        tools: {
            title: 'Tools',
            items: 'code wordcount'
        },
        table: {
            title: 'Table',
            items: 'inserttable | cell row column | tableprops deletetable'
        },
        help: {
            title: 'Help', items: 'help'
        }
    },
    mobile: {
        menubar: true
    },
    paste_data_images: true,
    automatic_uploads: false,
    relative_urls: false,
    remove_script_host: false,
    document_base_url: base_url,
    valid_elements: ""
        + "a[accesskey|charset|class|coords|dir<ltr?rtl|href|hreflang|id|lang|name"
        + "|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rel|rev"
        + "|shape<circle?default?poly?rect|style|tabindex|title|target|type],"
        + "abbr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "acronym[class|dir<ltr?rtl|id|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "address[class|align|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "applet[align<bottom?left?middle?right?top|alt|archive|class|code|codebase"
        + "|height|hspace|id|name|object|style|title|vspace|width],"
        + "area[accesskey|alt|class|coords|dir<ltr?rtl|href|id|lang|nohref<nohref"
        + "|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup"
        + "|shape<circle?default?poly?rect|style|tabindex|title|target],"
        + "base[href|target],"
        + "basefont[color|face|id|size],"
        + "bdo[class|dir<ltr?rtl|id|lang|style|title],"
        + "big[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "blockquote[cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick"
        + "|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
        + "|onmouseover|onmouseup|style|title],"
        + "body[alink|background|bgcolor|class|dir<ltr?rtl|id|lang|link|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onload|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|onunload|style|title|text|vlink],"
        + "br[class|clear<all?left?none?right|id|style|title],"
        + "button[accesskey|class|dir<ltr?rtl|disabled<disabled|id|lang|name|onblur"
        + "|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|style|tabindex|title|type"
        + "|value],"
        + "caption[align<bottom?left?right?top|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "center[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "cite[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "code[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "col[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id"
        + "|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title"
        + "|valign<baseline?bottom?middle?top|width],"
        + "colgroup[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl"
        + "|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title"
        + "|valign<baseline?bottom?middle?top|width],"
        + "dd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
        + "del[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "dfn[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "dir[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "div[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "dl[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "dt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
        + "em/i[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "fieldset[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "font[class|color|dir<ltr?rtl|face|id|lang|size|style|title],"
        + "form[accept|accept-charset|action|class|dir<ltr?rtl|enctype|id|lang"
        + "|method<get?post|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onreset|onsubmit"
        + "|style|title|target],"
        + "frame[class|frameborder|id|longdesc|marginheight|marginwidth|name"
        + "|noresize<noresize|scrolling<auto?no?yes|src|style|title],"
        + "frameset[class|cols|id|onload|onunload|rows|style|title],"
        + "h1[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "h2[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "h3[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "h4[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "h5[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "h6[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "head[dir<ltr?rtl|lang|profile],"
        + "hr[align<center?left?right|class|dir<ltr?rtl|id|lang|noshade<noshade|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|size|style|title|width],"
        + "html[dir<ltr?rtl|lang|version],"
        + "iframe[align<bottom?left?middle?right?top|class|frameborder|height|id"
        + "|longdesc|marginheight|marginwidth|name|scrolling<auto?no?yes|src|style"
        + "|title|width],"
        + "img[align<bottom?left?middle?right?top|alt|border|class|dir<ltr?rtl|height"
        + "|hspace|id|ismap<ismap|lang|longdesc|name|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|src|style|title|usemap|vspace|width],"
        + "input[accept|accesskey|align<bottom?left?middle?right?top|alt"
        + "|checked<checked|class|dir<ltr?rtl|disabled<disabled|id|ismap<ismap|lang"
        + "|maxlength|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onselect"
        + "|readonly<readonly|size|src|style|tabindex|title"
        + "|type<button?checkbox?file?hidden?image?password?radio?reset?submit?text"
        + "|usemap|value],"
        + "ins[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "isindex[class|dir<ltr?rtl|id|lang|prompt|style|title],"
        + "kbd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "label[accesskey|class|dir<ltr?rtl|for|id|lang|onblur|onclick|ondblclick"
        + "|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
        + "|onmouseover|onmouseup|style|title],"
        + "legend[align<bottom?left?right?top|accesskey|class|dir<ltr?rtl|id|lang"
        + "|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "li[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type"
        + "|value],"
        + "link[charset|class|dir<ltr?rtl|href|hreflang|id|lang|media|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|rel|rev|style|title|target|type],"
        + "map[class|dir<ltr?rtl|id|lang|name|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "menu[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "meta[content|dir<ltr?rtl|http-equiv|lang|name|scheme],"
        + "noframes[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "noscript[class|dir<ltr?rtl|id|lang|style|title],"
        + "object[align<bottom?left?middle?right?top|archive|border|class|classid"
        + "|codebase|codetype|data|declare|dir<ltr?rtl|height|hspace|id|lang|name"
        + "|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|standby|style|tabindex|title|type|usemap"
        + "|vspace|width],"
        + "ol[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|start|style|title|type],"
        + "optgroup[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "option[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick"
        + "|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
        + "|onmouseover|onmouseup|selected<selected|style|title|value],"
        + "p[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|style|title],"
        + "param[id|name|type|value|valuetype<DATA?OBJECT?REF],"
        + "pre/listing/plaintext/xmp[align|class|dir<ltr?rtl|id|lang|onclick|ondblclick"
        + "|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout"
        + "|onmouseover|onmouseup|style|title|width],"
        + "q[cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "s[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
        + "samp[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "script[charset|defer|language|src|type],"
        + "select[class|dir<ltr?rtl|disabled<disabled|id|lang|multiple<multiple|name"
        + "|onblur|onchange|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|size|style"
        + "|tabindex|title],"
        + "small[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "span[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "strike[class|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title],"
        + "strong/b[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "style[dir<ltr?rtl|lang|media|title|type],"
        + "sub[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "sup[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "table[align<center?left?right|bgcolor|border|cellpadding|cellspacing|class"
        + "|dir<ltr?rtl|frame|height|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rules"
        + "|style|summary|title|width],"
        + "tbody[align<center?char?justify?left?right|char|class|charoff|dir<ltr?rtl|id"
        + "|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|style|title"
        + "|valign<baseline?bottom?middle?top],"
        + "td[abbr|align<center?char?justify?left?right|axis|bgcolor|char|charoff|class"
        + "|colspan|dir<ltr?rtl|headers|height|id|lang|nowrap<nowrap|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup"
        + "|style|title|valign<baseline?bottom?middle?top|width],"
        + "textarea[accesskey|class|cols|dir<ltr?rtl|disabled<disabled|id|lang|name"
        + "|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onselect"
        + "|readonly<readonly|rows|style|tabindex|title],"
        + "tfoot[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id"
        + "|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|style|title"
        + "|valign<baseline?bottom?middle?top],"
        + "th[abbr|align<center?char?justify?left?right|axis|bgcolor|char|charoff|class"
        + "|colspan|dir<ltr?rtl|headers|height|id|lang|nowrap<nowrap|onclick"
        + "|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove"
        + "|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup"
        + "|style|title|valign<baseline?bottom?middle?top|width],"
        + "thead[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id"
        + "|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown"
        + "|onmousemove|onmouseout|onmouseover|onmouseup|style|title"
        + "|valign<baseline?bottom?middle?top],"
        + "title[dir<ltr?rtl|lang],"
        + "tr[abbr|align<center?char?justify?left?right|bgcolor|char|charoff|class"
        + "|rowspan|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title|valign<baseline?bottom?middle?top],"
        + "tt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
        + "u[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
        + "|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
        + "ul[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown"
        + "|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
        + "|onmouseup|style|title|type],"
        + "var[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress"
        + "|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style"
        + "|title],"
        + "section[class]",
    setup: function (editor) {
        initImageUpload(editor);
        var base = main_url + '/public/js/admin/price-tinymce.js';
        var scriptLoader = new tinymce.dom.ScriptLoader();
        scriptLoader.add(base);
        scriptLoader.loadQueue();
    },
});

// editor = tinymce.get('post_content').getContent();
// console.log(editor,'aaa');
function initImageUpload(editor) {
    // create input and insert in the DOM
    var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
    $(editor.getElement()).parent().append(inp);

    // add the image upload button to the editor toolbar
    editor.addButton('imageupload', {
        text: '',
        icon: 'image',
        onclick: function (e) { // when toolbar button is clicked, open file select modal
            inp.trigger('click');
        }
    });

    // when a file is selected, upload it to the server
    inp.on("change", function (e) {
        uploadFile($(this), editor);
    });
}

function uploadFile(inp, editor) {
    var input = inp.get(0);
    var data = new FormData();
    data.append('file', input.files[0]);
    var value = '';
    $.ajax({
        url: base_url + '/post/uploaded_image_tinymce',
        type: 'POST',
        data: data,
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function (data, textStatus, jqXHR) {
            editor.insertContent('<img class="content-img" src="' + JSON.parse(data).file_path + '"/>');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // if(jqXHR.responseText) {
            // 	errors = JSON.parse(jqXHR.responseText).errors
            // 	alert('Error uploading image: ' + errors.join(", ") + '. Make sure the file is an image and has extension jpg/jpeg/png.');
            // }
        }
    });
}

/*format currency in USD*/
function formatCurrencyByUSD(num) {
    var strNum = num.toString().replaceAll(",", "");
    if ($.isNumeric(strNum) == false) {
        return "false";
    }
    var numFM = Number(strNum);
    if (numFM < 0) {
        return "false_0";//Not permit < 0
    }
    var roundedNum = numFM.toFixed(2);
    var before = roundedNum.toString();
    var after = "00";
    if (roundedNum.indexOf(".") > 0) {
        var parts = roundedNum.split(".");
        before = parts[0];
        after = parts[1];
    }
    if (before != "") {
        before = before.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    var result = before + "." + after;
    return result;
}

/*@params:
* $currentValue has format: 1,234.56
* $appendValue is an float
* @result: $currentValue + $appendValue as format: 1,234.56
*/
function appendNumWithFormat(currentValue, appendValue, numMonths) {
    var strCurrentValue = currentValue.toString().replaceAll(",", "");
    var result = Number(strCurrentValue) + appendValue * numMonths;
    return formatCurrencyByUSD(result);
}

$(document).ready(function () {
    //start - keep active status - tuannt
    (function (a) {
        if (a.includes('/post?') || a.includes('/post/')) {
            $(".sidebar .nav-item a[href*='/post?']").addClass('active');
            $(".sidebar .nav-item a[href*='/post/']").addClass('active');
        } else if (a.includes('/post_category?') || a.includes('/post_category/')) {
            $(".sidebar .nav-item a[href*='/post_category?']").addClass('active');
            $(".sidebar .nav-item a[href*='/post_category/']").addClass('active');
        } else if (a.includes('/contact-user?') || a.includes('/contact-user/')) {
            $(".sidebar .nav-item a[href*='/contact-user?']").addClass('active');
            $(".sidebar .nav-item a[href*='/contact-user/']").addClass('active');
        } else if (a.includes('/register_promotion?') || a.includes('/register_promotion/')) {
            $(".sidebar .nav-item a[href*='/register_promotion?']").addClass('active');
            $(".sidebar .nav-item a[href*='/register_promotion/']").addClass('active');
        } else if (a.includes('/menu?') || a.includes('/menu/')) {
            $(".sidebar .nav-item a[href*='/menu?']").addClass('active');
            $(".sidebar .nav-item a[href*='/menu/']").addClass('active');
        } else if (a.includes('/page-admin?') || a.includes('/page-admin/')) {
            $(".sidebar .nav-item a[href*='/page-admin?']").addClass('active');
            $(".sidebar .nav-item a[href*='/page-admin/']").addClass('active');
        } else if (a.includes('/dynamic-page?') || a.includes('/dynamic-page/')) {
            $(".sidebar .nav-item a[href*='/dynamic-page?']").addClass('active');
            $(".sidebar .nav-item a[href*='/dynamic-page/']").addClass('active');
        } else if (a.includes('/language_code?') || a.includes('/language_code/')) {
            $(".sidebar .nav-item a[href*='/language_code?']").addClass('active');
            $(".sidebar .nav-item a[href*='/language_code/']").addClass('active');
        } else if (a.includes('/language?') || a.includes('/language/')) {
            $(".sidebar .nav-item a[href*='/language?']").addClass('active');
            $(".sidebar .nav-item a[href*='/language/']").addClass('active');
        } else if (a.includes('/mail?') || a.includes('/mail/')) {
            $(".sidebar .nav-item a[href*='/mail?']").addClass('active');
            $(".sidebar .nav-item a[href*='/mail/']").addClass('active');
        } else if (a.includes('/admins?') || a.includes('/admins/')) {
            $(".sidebar .nav-item a[href*='/admins?']").addClass('active');
            $(".sidebar .nav-item a[href*='/admins/']").addClass('active');
        }
    })(window.location.href);
    //end - keep active status - tuannt


    //format on load
    var currencyValue = $("#input_currency").val();
    if (currencyValue != null) {
        currencyValue = formatCurrencyByUSD(currencyValue);
        if (currencyValue != "false") {
            $("#input_currency").val(currencyValue);
        }
    }
    //on change with input_currency on the view
    $("#input_currency").change(function () {
        var myValue = $(this).val();
        myValue = formatCurrencyByUSD(myValue);
        if (myValue == "false") {
            $("#lbl_input_currency").text("Giá trị sai định dạng");
            $("#lbl_input_currency").css('color', 'red');
            $("#lbl_input_currency").css('font-style', 'italic');
            return;
        }
        $("#input_currency").val(myValue);
    });
    //end-of
    //For loading date-picker
    //Check exist class to do
    if ($('.js__date-picker').length > 0) {
        $('.js__date-picker').datepicker({
            format: 'dd-mm-yyyy',
        });
    }

    $('.choose__all').click(function () {
        if ($(this).is(':checked') == true) {
            $('.input__check').prop('checked', true);
        } else {
            $('.input__check').prop('checked', false);
        }
    });
    //End-of
    // ajax change public post
    $('.public_post').on('click', function () {
        var button = $(this);
        // get data from button delete
        var post_id = $(this).attr('data-id');
        var post_status = $(this).attr('data-status');
        var result = confirm("Thay đổi trạng thái bài viết?");
        if (result) {
            $.ajax({
                url: url_status_post,
                data: {
                    "post_id": post_id,
                    "post_status": post_status,
                    [csrfName]: csrfHash
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                    if (data.countUpdated != 'error') {
                        // in ra select server
                        toastr.success('Thay đổi trạng thái thành công!');
                        window.location.reload();
                    } else {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        }

    });
    // delete post
    $('.btn__delete').click(function () {
        var list_post_id = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                list_post_id.push($(this).attr('data-id-post'));
            }
        });
        if (list_post_id.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bài viết!');
            return;
        }
        var result = confirm("Xác nhận xóa bài viết?");
        if (result) {
            $('#listGroupPostId').val(list_post_id);
            $('.list_group_post').submit();
        }
    })
    // delete category
    $('.btn__delete-category').click(function () {
        var list_category_id = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                list_category_id.push($(this).attr('data-category-id'));
            }
        });
        if (list_category_id.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 danh mục!');
            return;
        }
        var result = confirm("Xác nhận xóa danh mục?");
        if (result) {
            $('#listGroupPostCategoryId').val(list_category_id);
            $('.list_group_id').submit();
        }
    })


    // send email promotion

    $('.btn__send_promotion').click(function () {
        var mail_template = $('.js__choose-mail').val();
        if (mail_template != '') {
            var register_promotion_list_id = [];
            $(".input__check").each(function () {
                if ($(this).is(":checked")) {
                    register_promotion_list_id.push($(this).attr('data-register-promotion-id'));
                }
            });
            if (register_promotion_list_id.length <= 0) {
                Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
                return;
            }
            var result = confirm("Xác nhận gửi email ?");
            if (result) {
                $('#sendPromotionList').val(register_promotion_list_id);
                $('#mailTemplateId').val(mail_template);
                $('.send_promotion_list').submit();
            }
        } else {
            Swal.fire('Vui lòng chọn mẫu mail cần gửi!');
        }


    })
    // delete customer promotion

    $('.btn__delete_promotion').click(function () {
        var register_promotion_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                register_promotion_list.push($(this).attr('data-register-promotion-id'));
            }
        });
        if (register_promotion_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa bản ghi?");
        if (result) {
            $('#registerPromotionList').val(register_promotion_list);
            $('.register_promotion_list').submit();
        }
    })


    // delete service
    $('.btn__delete-service').click(function () {
        var list_service_group = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                list_service_group.push($(this).attr('data-service-group'));
            }
        });
        if (list_service_group.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 dịch vụ!');
            return;
        }
        var result = confirm("Xác nhận xóa dịch vụ?");
        if (result) {
            $('#listServiceGroupId').val(list_service_group);
            $('.list_service_group').submit();
        }
    })

    $('.btn__delete-contact').click(function () {
        var contact_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                contact_list.push($(this).attr('data-contact-id'));
            }
        });
        if (contact_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa liên hệ?");
        if (result) {
            $('#contactList').val(contact_list);
            $('.contact_list').submit();
        }
    })

    // delete mail
    $('.btn__delete-mail').click(function () {
        var list_mail_id = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                list_mail_id.push($(this).attr('data-mail-id'));
            }
        });
        if (list_mail_id.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 mail!');
            return;
        }
        var result = confirm("Xác nhận xóa mail?");
        if (result) {
            $('#listMailGroupId').val(list_mail_id);
            $('.list_mail_id').submit();
        }
    })

    // thay đổi trạng thái contact
    $('.contact_status').on('click', function () {
        var button_contact = $(this);
        // get data from button delete
        var contact_id = $(this).attr('data-id');
        var result = confirm("Thay đổi trạng thái liên hệ?");
        if (result) {
            $.ajax({
                url: url_contact_status,
                data: {
                    contact_id: contact_id,
                    [csrfName]: csrfHash
                },
                dataType: 'JSON',
                contentType: 'application/json; charset=utf-8',
                method: "GET",
                success: function (data) {
                    if (data.countUpdated != 'error') {
                        // in ra select server
                        toastr.success('Thay đổi trạng thái thành công!');
                        window.location.reload();
                    } else {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        }
    });

    // change status service
    $('.service_status').on('click', function () {
        var button = $(this);
        // get data from button delete
        var service_group = $(this).attr('data-group');
        var service_status = $(this).attr('data-status');
        var result = confirm("Thay đổi trạng thái dịch vụ?");
        if (result) {
            $.ajax({
                url: url_service_status,
                data: {
                    service_group: service_group,
                    service_status: service_status,
                    [csrfName]: csrfHash
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                    if (data.countUpdated != 'error') {
                        // in ra select server
                        toastr.success('Thay đổi trạng thái thành công!');
                        window.location.reload();
                    } else {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        }

    });

    // delete lang code

    $('.btn__delete-language-code').click(function () {
        var lang_code_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                lang_code_list.push($(this).attr('data-id'));
            }
        });
        if (lang_code_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa bản ghi?");
        if (result) {
            $('#listlanguageCodeId').val(lang_code_list);
            $('.list_language_code_id').submit();
        }
    })
    // delete lang
    $('.btn__delete-language').click(function () {
        var lang_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                lang_list.push($(this).attr('data-language-id'));
            }
        });
        if (lang_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa ngôn ngữ?");
        if (result) {
            $('#listLanguageId').val(lang_list);
            $('.list_language_id').submit();
        }
    })

    // change status mail
    $('.mail_status').on('click', function () {
        var button = $(this);
        // get data from button delete
        var mail_id = $(this).attr('data-group');
        var mail_status = $(this).attr('data-status');
        var result = confirm("Thay đổi trạng thái mail?");
        if (result) {
            $.ajax({
                url: url_mail_status,
                data: {
                    mail_id: mail_id,
                    mail_status: mail_status,
                    [csrfName]: csrfHash
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                    if (data.countUpdated != 'error') {
                        // in ra select server
                        toastr.success('Thay đổi trạng thái thành công!');
                        window.location.reload();
                    } else {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        }

    });

//change pass + reset password
    $('.js__change-password').click(function () {
        var admin_id = $(this).attr('data-id');
        if (admin_id != '') {
            $('#jsAdminId').val(admin_id);
        }
        $('#changePasswordModal').modal('show');

    })


    // hide lang
    $('body').delegate('.js__hide-input', 'click', function () {
        var key = $(this).attr('data-key');
        $('.select-num-' + key).remove();
        $('.input-num-' + key).remove();
        $(this).remove();
    })

    // auto tạo url bài post khi nhập title
    $('#post_title').keyup(function () {
        var value = $(this).val();
        var slug = $(this).attr('data-slug');
        var lang = $(this).attr('data-lang');
        var category = $(this).attr('data-category-slug');
        if (category) {
            slug = category;
        }
        value = replace_word(value);

        var lang_select = $('#choose-lang-create').val();
        var category_select = $('#category_id').val();
        // console.log(lang_select,'a');
        // console.log(category_select,'v');
        if (lang_select != null && category_select != null) {
            var canonical = main_url + '/' + lang + '/' + slug + '/' + value;
            $('#og_url, #seo_canonical').val(canonical);
        } else {
            $('#og_url, #seo_canonical').val('');
        }

    })


    // $('#post_title_edit').keyup(function () {
    //     var value = $(this).val();
    //     var slug = $(this).attr('data-slug');
    //     var lang = $(this).attr('data-lang');
    //     var category = $(this).attr('data-category-slug');
    //     if (category) {
    //         slug = category;
    //     }
    //     value = replace_word(value);
    //     var canonical = main_url + '/' + lang + '/' + slug + '/' + value;
    //     $('#og_url, #seo_canonical').val(canonical);
    // })

    $('#dynamic-page').change(function () {
        var value = $(this).val();
        var lang = $('#dynamic-lang').val();
        if (lang != '') {
            var url = main_url + '/' + lang + '/' + value;
            $(this).val(url);
            $('#seo_canonical').val(url);
        }
    })

    $('#dynamic-lang').change(function () {
        var lang = $(this).val();
        var og_url = $('#dynamic-page-edit,#dynamic-page').val();
        var value = og_url.split('/');
        value = value[value.length - 1];
        if (og_url != '') {
            var url = main_url + '/' + lang + '/' + value;
            $('#seo_canonical,#dynamic-page-edit,#dynamic-page').val(url);
        }
    })


    $('#dynamic-page-edit').change(function () {
        var value = $(this).val();
        $('#seo_canonical').val(value);
    })


    $('#category_id').on('change', function () {
        $('.card-body').removeClass('js__change_category');
        var slug_category = $(this).find(':selected').attr('data-slug');
        $('#post_title').attr('data-slug', slug_category);

        var value_title = $('#post_title_edit').val();
        value_title = replace_word(value_title);
        var lang = $('#choose-lang-create-edit').val();

        if (value_title != null && lang != null) {
            $('#post_title_edit').attr('data-slug', slug_category);
            var canonical = main_url + '/' + lang + '/' + slug_category + '/' + value_title;
            $('#og_url, #seo_canonical').val(canonical);
        } else {
            $('#og_url, #seo_canonical').val("");
        }
    });


    // auto tạo url bài danh mục khi nhập title
    $('#post_title_category').keyup(function () {
        var value = $(this).val();
        var lang = $(this).attr('data-lang');
        value = replace_word(value);
        var url_category = main_url + '/' + lang + '/' + value;
        $('#og_url,#seo_canonical').val(url_category);
    })

    $('#post_title_page').keyup(function () {
        var value = $(this).val();
        var lang = $(this).attr('data-lang');
        value = replace_word(value);
        var url_category = main_url + '/' + lang + '/page/' + value;
        $('#og_url,#seo_canonical').val(url_category);
    })

    $('#post_title_home').keyup(function () {
        var value = $(this).attr('data-lang');
        var url_home = main_url + '/' + value;
        $('#og_url,#seo_canonical').val(url_home);
    })
    // post_type change
    $('#post_type_edit').on('change', function () {
        var post_type = $(this).val();
        $('#choose-lang-create-edit').attr('disabled', false);
        $('.choose_lang_edit').val("");
        $('#category_id').val("");
        $('#category_id').attr('disabled', true);
    })

    $('#post_type').on('change', function () {
        var post_type = $(this).val();
        $('#choose-lang-create').attr('disabled', false);
        $('#choose-lang-create').attr('data-post-type', post_type);
        $('#choose-lang-create').val("");
    })
    // select ngôn ngữ change
    $('body').delegate('#choose-lang-create', 'change', function () {
        var lang = $(this).val();
        var post_type = $(this).attr('data-post-type');
        $('#category_id').attr('disabled', false);
        $('#category_id').load(url_get_category_register + post_type + '/' + lang);
    })


    $('body').delegate('#choose-lang-create-edit', 'change', function () {
        var lang = $(this).val();
        var post_type = $('#post_type_edit').val();
        var category = $(this).attr('data-category-slug');
        var title_value = $('#post_title_edit').val();
        title_value = replace_word(title_value);
        var url_home = '';
        if (category) {
            url_home = main_url + '/' + lang + '/' + category + '/' + title_value;
            $('#post_title').attr('data-category-slug', category);
        }
        if (lang) {
            $('#category_id').attr('disabled', false);
            $('#category_id').load(url_get_category_register + post_type + '/' + lang);

        }
        $('#post_title').attr('data-lang', lang);
        $('#og_url,#seo_canonical').val(url_home);
    })
    $('body').delegate('#choose-lang-create-page', 'change', function () {
        var lang = $(this).val();
        var title_value = $('#post_title_page').val();
        title_value = replace_word(title_value);
        var url_home = main_url + '/' + lang + '/page/' + title_value;
        $('#post_title_page').attr('data-lang', lang);
        $('#og_url,#seo_canonical').val(url_home);
    })

    $('body').delegate('#choose-lang-create-category', 'change', function () {
        var lang = $(this).val();
        var title_value = $('#post_title_category').val();
        title_value = replace_word(title_value);
        var url_home = main_url + '/' + lang + '/' + title_value;
        $('#post_title_category').attr('data-lang', lang);
        $('#og_url,#seo_canonical').val(url_home);
    })


    $('body').delegate('#choose-lang-create-home', 'change', function () {
        var lang = $(this).val();
        $('#post_title_home').attr('data-lang', lang);
        var url_home = main_url + '/' + lang;
        $('#og_url,#seo_canonical').val(url_home);
    })


// check slug ton tai
    $('#post_title, #post_title_category, #post_title_home, #post_title_page, #post_title_dynamic').on('change', function () {
        var value = $(this).val();
        var id = $(this).attr('data-id');
        if (value) {
            $.ajax({
                url: url_slug_isset + '/' + value + '/' + id,
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                    if (data == 1) {
                        toastr.error('Đường dẫn đã tồn tại, cần thay đổi tiêu đề!');
                        $('#post_title').addClass('boxshadow');
                        $('.js__btn-submit').hide();
                    } else {
                        toastr.success('Đường dẫn phù hợp!');
                        $('.js__btn-submit').show();
                        $('#post_title').removeClass('boxshadow');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        } else {
            toastr.error('Vui lòng nhập tiêu đề!');
        }
    });

    // check slug tồn tại khi thay đổi url của danh mục bài viết 26/05/2022
    $('.og_url_category').on('change', function () {
        var value = $(this).val();
        var id = $(this).attr('data-id');
        var lang = $('.post_title_category').attr('data-lang');
        var array = value.split(main_url + '/' + lang + '/');
        /* th tự chỉnh sửa url k có url thì trả về false */
        if (array.length <= 1) {
            toastr.error('Đường dẫn không phù hợp!');
            $('.og_url_category').addClass('boxshadow');
            $('.js__btn-submit').hide();
        }
        else if (array.length == 2) {
            // trường hợp check cho tạo danh mục bài viết trong chuỗi cắt vị trí 0 phải null, và vị trị thứ 1 k tồn tại kí tự "/"
            if (array[0] == '' && array[1].split('/').length == 1) {
                $.ajax({
                    url: url_slug_isset + '/' + array[1] + '/' + id,
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'JSON',
                    method: "GET",
                    success: function (data) {
                        if (data == 1) {
                            toastr.error('Đường dẫn đã tồn tại!');
                            $('.og_url_category').addClass('boxshadow');
                            $('.js__btn-submit').hide();
                        } else {
                            toastr.success('Đường dẫn phù hợp!');
                            $('.js__btn-submit').show();
                            $('.og_url_category').removeClass('boxshadow');
                            // gán url mới cho input canonical
                            $('#seo_canonical').val(value);
                            // gán value slug cho input slug
                            $('#slugPost').val(array[1]);
                        }
                    },
                    error: function () {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                });
            } else  {
                toastr.error('Đường dẫn không phù hợp!');
                $('.og_url_category').addClass('boxshadow');
                $('.js__btn-submit').hide();
            }
        }
    });
    // check slug tồn tại khi thay đổi url bài viết 26/05/2022
    $('.og_url_post').on('change', function () {
        var value = $(this).val();
        var id = $(this).attr('data-id');
        var lang = $('.post_title').attr('data-lang');
        var array = value.split(main_url + '/' + lang + '/');
        /* th tự chỉnh sửa url k có url thì trả về false */
        if (array.length <= 1) {
            toastr.error('Đường dẫn không phù hợp!');
            $('.og_url_post').addClass('boxshadow');
            $('.js__btn-submit').hide();
        }
        else if (array.length == 2) {
            // trường hợp check cho tạo danh mục bài viết trong chuỗi cắt vị trí 0 phải null, và vị trị thứ 1 k tồn tại kí tự "/"
            var newValue = array[1].split('/');
            if (array[0] == '' && newValue.length == 2) {
                $.ajax({
                    url: url_slug_isset + '/' + newValue[1] + '/' + id,
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'JSON',
                    method: "GET",
                    success: function (data) {
                        if (data == 1) {
                            toastr.error('Đường dẫn đã tồn tại!');
                            $('.og_url_post').addClass('boxshadow');
                            $('.js__btn-submit').hide();
                        } else {
                            toastr.success('Đường dẫn phù hợp!');
                            $('.js__btn-submit').show();
                            $('.og_url_post').removeClass('boxshadow');
                            // gán url mới cho input canonical
                            $('#seo_canonical').val(value);
                            // gán value slug cho input slug
                            $('#slugPost').val(newValue[1]);
                        }
                    },
                    error: function () {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                });
            } else  {
                toastr.error('Đường dẫn không phù hợp!');
                $('.og_url_post').addClass('boxshadow');
                $('.js__btn-submit').hide();
            }
        }
    });
    // check slug tồn tại khi thay đổi url trang tĩnh 26/05/2022
    $('.og_url_page').on('change', function () {
        var value = $(this).val();
        var id = $(this).attr('data-id');
        var lang = $('.post_title_page').attr('data-lang');
        var array = value.split(main_url + '/' + lang + '/page/');
        /* th tự chỉnh sửa url k có url thì trả về false */

        if (array.length <= 1) {
            toastr.error('Đường dẫn không phù hợp!');
            $('.og_url_page').addClass('boxshadow');
            $('.js__btn-submit').hide();
        }
        else if (array.length == 2) {
            // trường hợp check cho tạo danh mục bài viết trong chuỗi cắt vị trí 0 phải null, và vị trị thứ 1 k tồn tại kí tự "/"
            if (array[0] == '' && array[1].split('/').length == 1) {
                $.ajax({
                    url: url_slug_isset + '/' + array[1] + '/' + id,
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'JSON',
                    method: "GET",
                    success: function (data) {
                        if (data == 1) {
                            toastr.error('Đường dẫn đã tồn tại!');
                            $('.og_url_page').addClass('boxshadow');
                            $('.js__btn-submit').hide();
                        } else {
                            toastr.success('Đường dẫn phù hợp!');
                            $('.js__btn-submit').show();
                            $('.og_url_page').removeClass('boxshadow');
                            // gán url mới cho input canonical
                            $('#seo_canonical').val(value);
                            // gán value slug cho input slug
                            $('#slugPost').val(array[1]);
                        }
                    },
                    error: function () {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                });
            } else  {
                toastr.error('Đường dẫn không phù hợp!');
                $('.og_url_page').addClass('boxshadow');
                $('.js__btn-submit').hide();
            }
        }
    });


    //delete img
    $('.js__delete-img').on('click', function () {
        var id = $(this).attr('data-id');
        var result = confirm("Xóa ảnh đại diện?");
        if (result) {
            $('.js__image').remove();
            $(this).remove();
            $.ajax({
                url: url_delete_image + '/' + id,
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                },
                error: function () {
                }
            });
        }
    });
    // js copy url
    $('.js__get-url').click(function () {
        $('.div__none').show();
    })
    $('body').delegate('.js__random-password', 'click', function () {
        $('#inputPassword, #inputPasswordConfirm').get(0).type = 'text';
        var value = makeRandom(16);
        $('#inputPassword').val(value);
        $('#inputPasswordConfirm').val(value);
    })

    function makeRandom(length) {
        var result = '';
        var characters = '!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }

    $('.js__active-admin').on('click', function () {
        var button = $(this);
        // get data from button delete
        var admin_id = $(this).attr('data-id');
        var active = $(this).attr('data-active');
        var result = confirm("Thay đổi trạng thái admin?");
        if (result) {
            $.ajax({
                url: url_active_admin,
                data: {
                    "admin_id": admin_id,
                    "active": active,
                    [csrfName]: csrfHash
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'JSON',
                method: "GET",
                success: function (data) {
                    if (data.countUpdated != 'error') {
                        // in ra select server
                        toastr.success('Thay đổi trạng thái thành công!');
                        button.hide();
                    } else {
                        toastr.error('Lỗi xin vui lòng thử lại sau!');
                    }
                },
                error: function () {
                    toastr.error('Lỗi xin vui lòng thử lại sau!');
                }
            });
        }

    });

    $('.btn__delete-admin').click(function () {
        var admin_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                admin_list.push($(this).attr('data-admin-id'));
            }
        });
        if (admin_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa admin?");
        if (result) {
            $('#listAdminId').val(admin_list);
            $('.list_admin_id').submit();
        }
    })
    $('.btn__delete-menu').click(function () {
        var menu_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                menu_list.push($(this).attr('data-menu-id'));
            }
        });
        if (menu_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa menu?");
        if (result) {
            $('#listMenuId').val(menu_list);
            $('.list_menu_id').submit();
        }
    })

    $('.btn__delete-page').click(function () {
        var menu_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                menu_list.push($(this).attr('data-page-id'));
            }
        });
        if (menu_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa trang tĩnh?");
        if (result) {
            $('#listPageId').val(menu_list);
            $('.list_page_id').submit();
        }
    })
    $('.btn__delete-dynamic-page').click(function () {
        var menu_list = [];
        $(".input__check").each(function () {
            if ($(this).is(":checked")) {
                menu_list.push($(this).attr('data-page-id'));
            }
        });
        if (menu_list.length <= 0) {
            Swal.fire('Vui lòng chọn ít nhất 1 bản ghi!');
            return;
        }
        var result = confirm("Xác nhận xóa trang động?");
        if (result) {
            $('#listPageId').val(menu_list);
            $('.list_page_id').submit();
        }
    })


    // mở disable select edit post
    $('#editPostForm').on('submit', function () {
        $('.choose_lang_edit').prop('disabled', false);
        $('.choose_category_edit').prop('disabled', false);
    });

    // nhaan ban bai viet
    $('.js_duplicate').click(function () {
        var result = confirm("Xác nhận nhân bản?");
        var data_id = $(this).attr('data-id');
        var data_menu = $(this).attr('data-menu');
        if (result) {
            window.location.href = duplicate_url + '/' + data_id + '/' + data_menu;
        }
    })

});

function copyToClipboard(id) {
    var textBox = document.getElementById(id);
    textBox.select();
    document.execCommand("copy");
    Toast.fire({
        icon: 'success',
        title: 'Đã copy!'
    })
}

var imgInp = document.getElementById('file');
var avatar = document.getElementById('avatar');
var js__image = document.getElementById('js__image');
if (imgInp) {
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            avatar.src = URL.createObjectURL(file);
            avatar.style.display = 'block';
            if (js__image) {
                js__image.style.display = 'none';
            }
        }
    }
}