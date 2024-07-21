<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            background-color: #fdd835;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }
        .table-container {
            background-color: white;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control, .btn {
            border-radius: 0;
        }
        .btn-add {
            background-color: #fdd835;
            border-color: #fdd835;
        }
        .btn-edit {
            background-color: #ffffff;
            border-color: #dcdcdc;
        }
        .category-icon {
            vertical-align: middle;
            margin-right: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h3>Kategori Baru</h3>
    </div>
    <div class="table-container p-4">
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-add mb-3" data-bs-toggle="modal" data-bs-target="#popupKategoriModal">
            Tambah Kategori Baru
        </button>

        <!-- Modal -->
        <div class="modal fade" id="popupKategoriModal" tabindex="-1" aria-labelledby="popupKategoriModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupKategoriModalLabel">Kategori Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Nama dompet baru" required>
                                <select class="form-select" name="icon" required>
                                    <option value="https://img.icons8.com/ios-filled/50/000000/airplane.png">Plane</option>
                                    <option value="https://img.icons8.com/ios-filled/50/000000/backpack.png">Backpack</option>
                                    <option value="https://img.icons8.com/ios-filled/50/000000/money.png">Money</option>
                                </select>
                                <button class="btn btn-add" type="submit">Tambah</button>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Kategori</th>
                                <th>Ubah</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <span class="category-view">
                                            <img src="{{ $category->icon }}" alt="icon" class="category-icon" width="24">
                                            <span class="category-name">{{ $category->name }}</span>
                                        </span>
                                        <form class="edit-form d-none" action="{{ route('categories.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-edit toggle-edit-form">
                                            <img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png" alt="edit" width="24">
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-edit-form').forEach(button => {
        button.addEventListener('click', () => {
            const tr = button.closest('tr');
            tr.querySelector('.category-view').classList.toggle('d-none');
            tr.querySelector('.edit-form').classList.toggle('d-none');
        });
    });
</script>
</body>
</html>
