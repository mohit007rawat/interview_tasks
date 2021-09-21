<?php include('include/header.php')?>
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Manage Details</div>
                        <hr>
                        <form method="post" action="<?=base_url('manage_meta/').$this->uri->segment('2').'/2'?>" id="" enctype="multipart/form-data">
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="title" value="<?=!empty($meta->title) ? $meta->title : set_value('title')?>" placeholder="Title">
                                    <?=form_error('title')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="description" 
                                    value="<?=!empty($meta->description) ? $meta->description : set_value('description')?>" placeholder="Description">
                                    <?=form_error('description')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keywords</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="keywords" value="<?=!empty($meta->keywords) ? $meta->keywords : set_value('keywords')?>" placeholder="Keywords">
                                    <?=form_error('keywords')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Og Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="og_title" value="<?=!empty($meta->og_title) ? $meta->og_title : set_value('og_title')?>" placeholder="og_title">
                                    <?=form_error('og_title')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Og Description</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="og_description" value="<?=!empty($meta->og_description) ? $meta->og_description : set_value('og_description')?>" placeholder="Og Description">
                                    <?=form_error('og_description')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Og Site Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="og_site_name" value="<?=!empty($meta->og_site_name) ? $meta->og_site_name : set_value('og_site_name')?>" placeholder="Og Site Name">
                                    <?=form_error('og_site_name')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Og Url</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="og_url" value="<?=!empty($meta->og_url) ? $meta->og_url : set_value('og_url')?>" placeholder="Og Url">
                                    <?=form_error('og_url')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Twitter Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="twitter_title" value="<?=!empty($meta->twitter_title) ? $meta->twitter_title : set_value('twitter_title')?>" placeholder="Twitter Title">
                                    <?=form_error('twitter_title')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Twitter Description</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="twitter_description" value="<?=!empty($meta->twitter_description) ? $meta->twitter_description : set_value('twitter_description')?>" placeholder="Twitter Description">
                                    <?=form_error('twitter_description')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Itemprop Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="itemprop_title" value="<?=!empty($meta->itemprop_title) ? $meta->itemprop_title : set_value('itemprop_title')?>" placeholder="Itemprop Title">
                                    <?=form_error('itemprop_title')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Itemprop Description</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="itemprop_description" value="<?=!empty($meta->itemprop_description) ? $meta->itemprop_description : set_value('itemprop_description')?>" placeholder="Itemprop Description">
                                    <?=form_error('itemprop_description')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Author</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="author" value="<?=!empty($meta->author) ? $meta->author : set_value('author')?>" placeholder="Author">
                                    <?=form_error('author')?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Page Topic</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="page_topic" value="<?=!empty($meta->page_topic) ? $meta->page_topic : set_value('page_topic')?>" placeholder="Page Topic">
                                    <?=form_error('page_topic')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Copyright</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="copyright" value="<?=!empty($meta->copyright) ? $meta->copyright : set_value('copyright')?>" placeholder="Copyright">
                                    <?=form_error('copyright')?>
                                </div>
                            </div><div class="form-group row">
                                <label class="col-sm-2 col-form-label">Robots</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="robots" value="<?=!empty($meta->robots) ? $meta->robots : set_value('robots')?>" placeholder="Robots">
                                    <?=form_error('robots')?>
                                </div>
                            </div><div class="form-group row">
                                <label class="col-sm-2 col-form-label">Rating</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="rating" value="<?=!empty($meta->rating) ? $meta->rating : set_value('rating')?>" placeholder="Rating">
                                    <?=form_error('rating')?>
                                </div>
                            </div><div class="form-group row">
                                <label class="col-sm-2 col-form-label">Google Bot</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="google_bot" value="<?=!empty($meta->google_bot) ? $meta->google_bot : set_value('google_bot')?>" placeholder="Google Bot">
                                    <?=form_error('google_bot')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Yahoo Seeker</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="yahoo_seeker" value="<?=!empty($meta->yahoo_seeker) ? $meta->yahoo_seeker : set_value('yahoo_seeker')?>" placeholder="Yahoo Seeker">
                                    <?=form_error('yahoo_seeker')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Msnbot</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="msnbot" value="<?=!empty($meta->msnbot) ? $meta->msnbot : set_value('msnbot')?>" placeholder="Msnbot">
                                    <?=form_error('msnbot')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Reply To</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="reply_to" value="<?=!empty($meta->reply_to) ? $meta->reply_to : set_value('reply_to')?>" placeholder="Reply To">
                                    <?=form_error('reply_to')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Allow Search</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="allow_search" value="<?=!empty($meta->allow_search) ? $meta->allow_search : set_value('allow_search')?>" placeholder="Allow Search">
                                    <?=form_error('allow_search')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Revisit After</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="revisit_after" value="<?=!empty($meta->revisit_after) ? $meta->revisit_after : set_value('revisit_after')?>" placeholder="Revisit After">
                                    <?=form_error('revisit_after')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Distribution</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="distribution" value="<?=!empty($meta->distribution) ? $meta->distribution : set_value('distribution')?>" placeholder="Distribution">
                                    <?=form_error('distribution')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Expires</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="expires" value="<?=!empty($meta->expires) ? $meta->expires : set_value('expires')?>" placeholder="Expires">
                                    <?=form_error('expires')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Language</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="language" value="<?=!empty($meta->language) ? $meta->language : set_value('language')?>" placeholder="Language">
                                    <?=form_error('language')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Script Application Json One</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="first_json_script_application" placeholder="Script Application Json One"><?=!empty($meta->first_json_script_application) ? $meta->first_json_script_application : set_value('first_json_script_application')?></textarea>
                                    <?=form_error('first_json_script_application')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Script Application Json Two</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="second_json_script_application" placeholder="Script Application Json Two"><?=!empty($meta->second_json_script_application) ? $meta->second_json_script_application : set_value('second_json_script_application')?></textarea>
                                    <?=form_error('second_json_script_application')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Script Application Json Three</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="third_json_script_application" placeholder="Script Application Json Three"><?=!empty($meta->third_json_script_application) ? $meta->third_json_script_application : set_value('third_json_script_application')?></textarea>
                                    <?=form_error('third_json_script_application')?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Google Manager</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="google_manager" value="<?=!empty($meta->google_manager) ? $meta->google_manager : set_value('google_manager')?>" placeholder="Google Manager">
                                    <?=form_error('google_manager')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
</div>
<?php include('include/footer.php')?>
      
 <script type="text/javascript">
    $(document).ready(function(){

     CKEDITOR.replace( 'cat_description' );
});
</script>