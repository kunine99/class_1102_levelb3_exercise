<!-- 預告片 -->
<div>
    <h4 class='ct'>預告片清單</h4>
    <div style="display:flex" class="ct">
        <div style="width:25%;background:#eee">預告片海報</div>
        <div style="width:25%;background:#eee">預告片片名</div>
        <div style="width:25%;background:#eee">預告片排序</div>
        <div style="width:25%;background:#eee">操作</div>
    </div>
    
    <form action="api/edit_poster.php" method="post">
        <div style="overflow:auto;height:200px">
            <?php
            $rows=$Poster->all(" ORDER by `rank`");
            foreach($rows as $key => $row){
                $checked=($row['sh']==1)?"checked":"";
                // rows是二微陣列，每一筆都慧倫一次把變數給row
                // 但沒有key 來當index(索引值?)? 
            if($key==0){
                $up=$row['id'] . "-" . $row['id'];
                $down=$row['id'] . "-" . $rows[$key+1]['id'];
            }

            if($key==(count($rows)-1)){
                $down=$row['id'] . "-" . $row['id'];
                $up=$row['id'] . "-" . $rows[$key-1]['id'];
            }

            if($key>0 && $key<(count($rows)-1)){
               $up=$row['id'] . "-" . $rows[$key-1]['id'];
               $down=$row['id'] . "-" . $rows[$key+1]['id'];
            }

                ?>
                <div style="display:flex" class="ct">
                <div style="width:25%;">
                    <img src="img/<?=$row['path'];?>" style="width:60px;">
                </div>
                <div style="width:25%;">
                    <input type="text" name="name[]" value="<?=$row['name'];?>"></div>
                    <div style="width:25%;">
                    <input type="button" class="sw" value="往上" data-sw="<?=$up;?>">
                    <input type="button" class="sw" value="往下" data-sw="<?=$down;?>">
                </div>
                <div style="width:25%;">
                    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>顯示
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
                    <select name="ani[]">
                        <option value="1"<?=($row['ani']==1)?"selected":"";?>>淡入淡出</option>
                        <option value="2"<?=($row['ani']==2)?"selected":"";?>>縮放</option>
                        <option value="3"<?=($row['ani']==3)?"selected":"";?>>滑入滑出</option>
                    </select>
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">  
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <input type="submit" value="確定修改">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<hr>
<div>
    <h4 class='ct'>新增預告片海報</h4>
    <form action="api/add_poster.php" method="post" enctype="multipart/form-data">
        <div class="ct">
            <label >
                預告片海報:
                <input type="file" name="path">
            </label>
            <label >
                預告片片名:
                <input type="text" name="name">
            </label>
        </div>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>

<script>
    // 用EXPLODE.  比如後面接檔名可以把黨名跟副檔名拆開變陣列
    $('.sw').on('click',function(){
        let id=$(this).data("sw").split("-");
        // 用GET 會得到很像陣列的字串，所以用POST才行得通
        // 送出id跟table 告訴我你是哪一個要做交換
        $.post("api/sw.php",{id,table:"poster"},()=>{
            // reload = 當前頁重整(像f5一樣)   
            location.reload();
        })
    })

</script>














