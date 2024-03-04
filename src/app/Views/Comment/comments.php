<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url('js/custom.js')?>"></script>

    <title>cSystem</title>
  </head>
  <body>
      <h4 class="text-center mb-4 pb-2">Comment System</h4>
      <div class="container">
          <ul class="nav justify-content-end">
            <li class="nav-item">
                <label for="sortBy"> Sort by:</label>
                <select name="sortBy" id="sortBy">
                    <option value="created_at" selected>Date</option>
                    <option value="id">Id</option>
                </select>
            </li>
            <li class="nav-item">
                <label for="sortDirection"> Sorting direction:</label>
                <select name="sortDirection" id="sortDirection">
                    <option value="DESC" selected>Descending</option>
                    <option value="ASC">Ascending</option>
                </select>
            </li>
          </ul>
      </div>
      <div>
          <div class="container py-4">
              <section id="commentSection">
              </section>
            
              <?= $pager->makeLinks($page,$perPage, $total, 'custom_view') ?>
          </div>

        <section id="errorsSection">
            </section>
        
          <div class="container">
          <?=form_open('addComment') ?>
            <div class="form-group row">
                <label for="email" class="col-xs-3 col-form-label mr-2">Email</label>
                <div class="col-xs-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Write an email" required value="<?=old('email',isset($dataComment['email'])? $dataComment['email'] : '')?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-xs-3 col-form-label mr-2">Text</label>
                <div class="col-xs-9">
                    <textarea name="comment" class="form-control" id="comment" cols="30" rows="10" placeholder="Write a comment" required><?=old('comment',isset($dataComment['text'])? $dataComment['text'] : '')?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-xs-3 col-form-label mr-2">Datetime</label>
                <div class="col-xs-9">
                    <input type="datetime-local" class="form-control" id="created_at" name="created_at" required value="<?=old('created_at',isset($dataComment['created_at'])? $dataComment['created_at'] : '')?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>

          <?=form_close()?>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>