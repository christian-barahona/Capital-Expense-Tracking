<?php
if(isset(
        $_POST['project'],
        $_POST['status'],
        $_POST['vendor'],
        $_POST['project_manager'],
        $_POST['apr'],
        $_POST['ip_code'],
        $_POST['capex_total_amount'],
        $_POST['po'],
        $_POST['po_amount'],
        $_POST['invoice_number'],
        $_POST['invoice_date'],
        $_POST['invoice_amount']
    )

    && !empty($_POST['project'])) {
    $project = $_POST['project'];
    $status = $_POST['status'];
    $vendor = $_POST['vendor'];
    $project_manager = $_POST['project_manager'];
    $apr = $_POST['apr'];
    $ip_code = $_POST['ip_code'];
    $capex_total_amount = $_POST['capex_total_amount'];
    $po = $_POST['po'];
    $po_amount = $_POST['po_amount'];
    $invoice_number = $_POST['invoice_number'];
    $invoice_date = $_POST['invoice_date'];
    $invoice_amount = $_POST['invoice_amount'];

    try {

        $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO capex_tracking (project, status, vendor, project_manager, apr, ip_code, capex_total_amount, po, po_amount, invoice_number, invoice_date, invoice_amount, po_remaining, capex_committed_po, capex_remaining_po, projects_apr_number_po, invoice_number_date) 
        VALUES ('$project', '$status', '$vendor', '$project_manager', '$apr', '$ip_code', '$capex_total_amount', '$po', '$po_amount', '$invoice_number', '$invoice_date', '$invoice_amount', '0', '0', '0', '0','0')");
        $stmt->execute();

        header('Location: ?p=view_all');
    }
    catch(PDOException $e)

    {
        echo "Could not save, here's why: " . $e->getMessage();
    }
}
else {
    echo "Complete all fields";
}
?>

<div class="container-fluid">
    <form method="POST" id="new-entry" action="">
        <div class="form-group row">
            <label class="col-1 col-form-label">Project</label>
            <div class="col-3">
                <input class="form-control" type="text" name="project" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Status</label>
            <div class="col-3">
                <select class="form-control" name="status">
                    <option selected>Approved</option>
                    <option>Planned</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Vendor</label>
            <div class="col-3">
                <input class="form-control" type="text" name="vendor">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Project Manager</label>
            <div class="col-3">
                <input class="form-control" type="text" name="project_manager">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">APR</label>
            <div class="col-3">
                <input class="form-control" type="text" name="apr">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">IP Code</label>
            <div class="col-3">
                <input class="form-control" type="text" name="ip_code">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Capex Total Amount</label>
            <div class="col-3">
                <input class="form-control" type="text" name="capex_total_amount">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">PO</label>
            <div class="col-3">
                <input class="form-control" type="text" name="po">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">PO Amount</label>
            <div class="col-3">
                <input class="form-control" type="text" name="po_amount">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Invoice Number</label>
            <div class="col-3">
                <input class="form-control" type="text" name="invoice_number">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Invoice Date</label>
            <div class="col-3">
                <input class="form-control" type="date" name="invoice_date">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-1 col-form-label">Invoice Amount</label>
            <div class="col-3">
                <input class="form-control" type="text" name="invoice_amount">
            </div>
        </div>
    </form>
    <button type="submit" class="btn btn-success" form="new-entry">Save</button>
    <button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
</div>