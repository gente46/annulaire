<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5" >Annuaire</h1>
        <div class="contact-form mt-3">
            <form id="contactForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
        <div class="contact-list mt-3">
            <h2>Contacts</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="contactTableBody">
                    <!-- Contacts will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadContacts() {
                $.ajax({
                    url: 'load_contacts.php',
                    method: 'GET',
                    success: function(response) {
                        $('#contactTableBody').html(response);
                    }
                });
            }

            loadContacts();

            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'add_contact.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#contactForm')[0].reset();
                        loadContacts();
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'delete_contact.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        loadContacts();
                    }
                });
            });

            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var row = $(this).closest('tr');
                var name = row.find('td:eq(0)').text();
                var email = row.find('td:eq(1)').text();
                var phone = row.find('td:eq(2)').text();

                $('#name').val(name);
                $('#email').val(email);
                $('#phone').val(phone);
                $('<input>').attr({
                    type: 'hidden',
                    id: 'editId',
                    name: 'id',
                    value: id
                }).appendTo('#contactForm');
                $('button[type=submit]').text('Modifier');
            });

            $('#contactForm').on('reset', function() {
                $('#editId').remove();
                $('button[type=submit]').text('Ajouter');
            });
        });
    </script>
</body>
</html>
