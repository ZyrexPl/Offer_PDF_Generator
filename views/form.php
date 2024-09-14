<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formularz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Wprowadź dane klienta i usługi</h1>
        <div class="row">
            <form action="index.php" method="post">
                <label for="companyName">Imię i nazwisko:</label>
                <input type="text" id="companyName" name="companyName" required><br>
                
                <label for="companyAddress">Ulica i numer:</label>
                <input type="text" id="companyAddress" name="companyAddress" required><br>

                <label for="companyCity">Kod i miasto:</label>
                <input type="text" id="companyCity" name="companyCity" required><br>

                <label for="leadTime">Termin realizacji:</label>
                <input type="text" id="leadTime" name="leadTime" required><br>

                <div id="services">
                    <h3>Usługi:</h3>
                    <div class="service-entry">
                        <input type="text" class="full-width" name="services[]" placeholder="Usługa" required>
                        <input type="text" name="guarantee[]" placeholder="Gwarancja" required>
                        <input type="number" name="prices[]" placeholder="Cena" required>
                    </div>
                </div>

                <button type="button" onclick="addService()">Dodaj usługę</button><br>
                
                <input type="submit" value="Generuj PDF">
            </form>
        </div>
    </div>
    <script>
        function addService() {
            var serviceDiv = document.createElement('div');
            serviceDiv.className = 'service-entry';
            
            var serviceInput = document.createElement('input');
            serviceInput.type = 'text';
            serviceInput.name = 'services[]';
            serviceInput.placeholder = 'Usługa';
            serviceInput.required = true;

            var guaranteeInput = document.createElement('input');
            guaranteeInput.type = 'text';
            guaranteeInput.name = 'guarantee[]';
            guaranteeInput.placeholder = 'Gwarancja';
            guaranteeInput.required = true;
            
            var priceInput = document.createElement('input');
            priceInput.type = 'number';
            priceInput.name = 'prices[]';
            priceInput.placeholder = 'Cena';
            priceInput.required = true;
            
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.innerText = 'Usuń';
            removeButton.onclick = function() {
                removeService(removeButton);
            };
            
            serviceDiv.appendChild(serviceInput);
            serviceDiv.appendChild(guaranteeInput);
            serviceDiv.appendChild(priceInput);
            serviceDiv.appendChild(removeButton);
            
            document.getElementById('services').appendChild(serviceDiv);
        }

        function removeService(button) {
            button.parentNode.remove();
        }
    </script>
</body>
</html>