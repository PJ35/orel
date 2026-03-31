<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@8.3.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        license_key: 'gpl'/*,
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'*/
    });
</script>
<h1>Vytvořit nový článek</h1>
<form action="<?= base_url('/article/store') ?>" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Nadpis</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Obsah</label>
        <textarea class="form-control" id="content" name="content" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Uložit</button>
</form>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const content = tinymce.get('content').getContent();
        if (!content.trim()) {
            e.preventDefault();
            alert('Obsah je povinný');
            return false;
        }
    });
</script>
<?= $this->endSection() ?>