document.addEventListener('DOMContentLoaded', function() {
    // Initial rows
    for (let i = 0; i < 3; i++) {
        addRow();
    }

    // Add row button event listener
    document.getElementById('add-row').addEventListener('click', addRow);

    // Reduce row button event listener
    document.getElementById('reduce-row').addEventListener('click', reduceRow);

    // Show result button event listener
    document.getElementById('show-result').addEventListener('click', function() {
        if (validateMarketShare()) {
            calculateHHI();
        }
    });

    // Download data button event listener
    document.getElementById('download-data').addEventListener('click', function() {
        var userInfo = document.getElementById('user-info');
        userInfo.style.display = 'block';

        if (validateMarketShare() && validateUserInfo()) {
            // Prepare data to send to server
            var formData = new FormData();
            formData.append('user_name', document.getElementById('user-name').value.trim());
            formData.append('user_email', document.getElementById('user-email').value.trim());
            formData.append('market_shares', JSON.stringify(getMarketShareData()));

            // Send data to server for PDF generation
            fetch('generate_pdf.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                } else {
                    throw new Error('Failed to generate PDF');
                }
            })
            .then(blob => {
                // Create a temporary link element
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'hhi_report.pdf';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to generate PDF');
            });
        }
    });
});

function addRow() {
    var table = document.getElementById('calculator').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);

    var serialNumber = table.rows.length;
    var serialCell = newRow.insertCell(0);
    var companyNameCell = newRow.insertCell(1);
    var marketShareCell = newRow.insertCell(2);
    var squareCell = newRow.insertCell(3);

    serialCell.textContent = serialNumber;
    companyNameCell.innerHTML = `<input type="text" name="company_names[]" class="company-name">`;
    marketShareCell.innerHTML = `<input type="number" name="market_shares[]" class="market-share">`;
    squareCell.innerHTML = `<input type="text" name="squares[]" class="square" readonly>`;

    // Update square value when market share changes
    var marketShareInput = marketShareCell.querySelector('.market-share');
    marketShareInput.addEventListener('input', function() {
        var squareInput = this.parentNode.nextElementSibling.querySelector('.square');
        var marketShare = parseFloat(this.value) || 0;
        squareInput.value = (marketShare * marketShare).toFixed(2);
        validateMarketShare();
    });
}

function reduceRow() {
    var table = document.getElementById('calculator').getElementsByTagName('tbody')[0];
    if (table.rows.length > 1) {
        table.deleteRow(-1);
        validateMarketShare();
    }
}

function validateMarketShare() {
    var marketShareInputs = document.querySelectorAll('.market-share');
    var totalMarketShare = 0;

    marketShareInputs.forEach(function(input) {
        totalMarketShare += parseFloat(input.value) || 0;
    });

    var resultDiv = document.getElementById('result');
    if (totalMarketShare > 100) {
        resultDiv.textContent = "Total market share cannot exceed 100%. Current total: " + totalMarketShare.toFixed(2) + "%";
        resultDiv.style.color = "red";
        return false;
    } else {
        resultDiv.textContent = "";
        resultDiv.style.color = "black";
        return true;
    }
}

function validateUserInfo() {
    var userName = document.getElementById('user-name').value.trim();
    var userEmail = document.getElementById('user-email').value.trim();

    if (!userName || !userEmail) {
        alert("Please enter your name and email before downloading the data.");
        return false;
    }
    return true;
}

function calculateHHI() {
    var squares = document.querySelectorAll('.square');
    var sum = 0;
    squares.forEach(function(square) {
        sum += parseFloat(square.value) || 0;
    });
    var hhi = sum.toFixed(2);

    var resultDiv = document.getElementById('result');
    resultDiv.textContent = "HHI: " + hhi;

    // Interpretation
    var interpretation;
    if (hhi <= 0) {
        interpretation = "Please enter the correct value.";
    } else if (hhi <= 1500) {
        interpretation = "Unconcentrated market, many small players.";
    } else if (hhi <= 2500) {
        interpretation = "Moderately concentrated, medium-sized firms present.";
    } else {
        interpretation = "Highly concentrated, few large players dominate.";
    }
    resultDiv.innerHTML += "<br>Interpretation: " + interpretation;
}

function getMarketShareData() {
    var marketShareInputs = document.querySelectorAll('.market-share');
    var data = [];
    marketShareInputs.forEach(function(input) {
        var companyName = input.parentNode.previousElementSibling.querySelector('.company-name').value.trim();
        var marketShare = parseFloat(input.value) || 0;
        data.push({ company_name: companyName, market_share: marketShare });
    });
    return data;
}
