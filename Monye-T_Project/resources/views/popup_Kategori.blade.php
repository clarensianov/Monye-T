<style>
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

<script>
    // Update Button
    document.querySelectorAll('.toggle-edit-form').forEach(button => {
        button.addEventListener('click', () => {
            const tr = button.closest('tr');
            tr.querySelector('.category-view').classList.toggle('d-none');
            tr.querySelector('.edit-form').classList.toggle('d-none');
        });
    });
</script>
