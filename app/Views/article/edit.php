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
<div class="container mt-5">
    <h1>Edit Article</h1>
    <form action="<?= base_url('/article/update/' . $article->id) ?>" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $article->title ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10"><?= $article->text ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const content = tinymce.get('content').getContent();
        if (!content.trim()) {
            e.preventDefault();
            alert('Content is required');
            return false;
        }
    });
</script>
<?= $this->endSection() ?>