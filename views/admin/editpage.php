<html>
  <head>
  <title><?= (!isset($page)) ? "Crea Nuova Pagina" : $page->title; ?></title>
      <link rel="stylesheet" type="text/css" href="/Assets/admin.css" />

      <script type="text/javascript">
          function add(fields)
          {
              var current = Date.now();
              var d = document;
              for(var i = 0; i < fields.length; i++)
              {
                  var input = d.createElement('input');
                  input.type = 'text';
                  input.name = 'sections['+current+']['+fields[i]+']';
                  d.getElementById('sections').appendChild(input);
              }
          }
      </script>
  </head>
  <body>
    <div id="wrapper">
        <?php if(Message::has('errors')){ ?>
        <div id="errors">
            <ul>
            <?php foreach(Message::recive('errors') as $error){ ?>
                <li><?= $error ?></li>
            <?php }?>
            </ul>
        </div>
        <?php } ?>

    <input type="hidden" name="id" value="<?= (!isset($page)) ? "": $page->id; ?>" /><br />
    	<label>Title</label><input type="text" name="title" value="<?= (!isset($page)) ? "": $page->title; ?>" /><br />
    	<label>template</label><input type="text" name="template" value="<?= (!isset($page)) ? "": $page->template; ?>" /><br />
    	<label>In Menu</label><input type="checkbox" name="inmenu" value="1" <?= (isset($page)) ? ($page->inmenu == 1) ? "checked" : '': ""; ?>/><br />
      <label>Body</label><textarea name="body"><?= (!isset($page)) ? "": $page->body; ?></textarea><br />
        <h2>sections</h2>
        <div id="sections">
        <?php
        if(isset($page)) {
            $i = 0;
            foreach ($page->sections as $section) {
                ?>
                <input type="hidden" name="sections[<?= $i ?>][id]"
                       value="<?= (!isset($section->id)) ? "" : $section->id; ?> ">
                <label>Title</label><input type="text" name="sections[<?= $i ?>][title]"
                                           value="<?= $section->title ?>"/><br/>
                <label>Body</label><input type="text" name="sections[<?= $i ?>][body]" value="<?= $section->body ?>"/>
                <br>
                <label>Delete</label><input type="checkbox" name="sections[<?= $i ?>][_destroy]" value="1"/><br/>
                <?php
                $i++;
            }
        }
        ?>
            </div>
        <a href="#" onclick="add(Array('title', 'body'))">Add</a>
      <input type="submit" class="btn-green" name="submit" value="Edit" />
      </form>
    </div>
  </body>
</html>
