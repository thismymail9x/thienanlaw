<label>Ngôn ngữ<span style="color: red;">(*)</span></label>
<select required class="form-control"  data-post-type="<?= $post_type?>" id="choose-lang-create" name="lang">
    <option value="">Chọn</option>
    <?php foreach (@$langCode as $key) { ?>
        <option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
    <?php } ?>
</select>