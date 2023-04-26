{{ $product->name }}

<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #ccc;
    }

    .company-info h1 {
        margin: 0;
        font-size: 32px;
    }

    .invoice-info h2 {
        margin: 0;
        font-size: 24px;
    }

    main {
        margin: 20px;
    }

    .bill-to {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tfoot td:first-of-type {
        font-weight: bold;
    }

    tfoot td:last-of-type {
        font-weight: bold;
        border-top: 2px solid #000;
    }

    footer {
        text-align: center;

    }
</style>

<body>
    <header>
        <div class="company-info">
            <h1>Acme Corporation</h1>
            <p>123 Main St.</p>
            <p>Anytown, USA</p>
            <p>acme@example.com</p>
        </div>
        <div class="invoice-info">
            <h2>Invoice</h2>
            <p>Invoice #: 12345</p>
            <p>Date: 04/25/2023</p>
        </div>
    </header>
    <main>
        <div class="bill-to">
            <h2>BILL TO:</h2>
            <p>John Doe</p>
            <p>123 Main St.</p>
            <p>Anytown, USA</p>
            <p>johndoe@example.com</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Widget A</td>
                    <td>2</td>
                    <td>$100.00</td>
                    <td>$200.00</td>
                </tr>
                <tr>
                    <td>Widget B</td>
                    <td>3</td>
                    <td>$50.00</td>
                    <td>$150.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Subtotal:</td>
                    <td>$350.00</td>
                </tr>
                <tr>
                    <td colspan="3">Shipping:</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td colspan="3">Total:</td>
                    <td>$370.00</td>
                </tr>
            </tfoot>
        </table>
    </main>
    <footer>
        <p>Thank you for your business!</p>
    </footer>
</body>

</html>
