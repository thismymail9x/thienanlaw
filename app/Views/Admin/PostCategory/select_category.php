
    <select required name="category_id" id="category_id" class="form-control category__load" aria-label="Danh mục "
            aria-describedby="span-1">
        <option value="" disabled selected>---Chọn danh mục---</option>
        <?php if (!empty($post_categories)) {
            foreach ($post_categories as $k =>$v){ ?>
                <option data-slug="<?=$v['slug']?>" value="<?= $v['post_id']?>"><?= $v['post_title']?></option>
                <?php
            }
        } ?>
    </select>
