 </section>
    </section>
  </section>
  <script src="<?= base_url()?>public/admin/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url()?>public/admin/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?= base_url()?>public/admin/js/app.js"></script>
  <script src="<?= base_url()?>public/admin/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url()?>public/admin/js/app.plugin.js"></script>

  <!--DATATABLES-->

  <script src="<?= base_url()?>public/admin/js/datatables/jquery.dataTables.min.js"></script>


  <?php if($contenido == 'articles/articles_add'):?>
  <!-- file input -->
  <script src="<?= base_url()?>public/admin/js/file-input/bootstrap-filestyle.min.js"></script>
  <!-- wysiwyg -->
  <script src="<?= base_url()?>public/admin/js/wysiwyg/jquery.hotkeys.js"></script>
  <script src="<?= base_url()?>public/admin/js/wysiwyg/bootstrap-wysiwyg.js"></script>
  <script src="<?= base_url()?>public/admin/js/wysiwyg/demo.js"></script>
  <!-- markdown -->
  <script src="<?= base_url()?>public/admin/js/markdown/epiceditor.min.js"></script>
  <script src="<?= base_url()?>public/admin/js/markdown/demo.js"></script>

  <?php endif ?>

  <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

  <script>var base_url = "<?= base_url()?>";</script>

  <script src="<?= base_url()?>public/admin/js/functions-admin.js"></script>


</body>
</html>