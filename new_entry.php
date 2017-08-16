<?php
$notice = "";
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
    $notice = "<div class='text-center hidden-print'><strong>All fields are required</strong></div>";
}
?>
<div class="container-fluid">
<?php
echo <<<EOT
<div class="text-center">
    <button type="button" class="btn btn-outline-success hidden-print" data-toggle="modal" data-target="#confirmation-modal">Save</button>
    <button type="button" class="btn btn-outline-danger hidden-print" id="go-back-button">Cancel</button>
    <p>$notice</p>
</div>
<form method="POST" action="" id="edit-values">
    <table class="table table-striped">
        <tbody>
        <tr>
            <th scope="row">Project</th>
            <td>
                <input class="form-control" type="text" value="" name="project" id="project" autofocus>
            </td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td>
                <select class="form-control" name="status">
                    <option selected></option>
                    <option>Approved</option>
                    <option>Planned</option>
                    <option>Closed</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Vendor</th>
            <td>
                <input class="form-control" type="text" value="" name="vendor">
            </td>
        </tr>
        <tr>
            <th scope="row">Project Manager</th>
            <td>
                <input class="form-control" type="text" value="" name="project_manager">
            </td>
        </tr>
        <tr>
            <th scope="row">APR</th>
            <td>
                <input class="form-control" type="text" value="" name="apr">
            </td>
        </tr>
        <tr>
            <th scope="row">IP Code</th>
            <td>
                <input class="form-control" type="text" value="" name="ip_code">
            </td>
        </tr>
        <tr>
            <th scope="row">Capex Total Amount</th>
            <td>
                <input class="form-control" type="text" value="" name="capex_total_amount">
            </td>
        </tr>
        <tr>
            <th scope="row">PO</th>
            <td>
                <input class="form-control" type="text" value="" name="po">
            </td>
        </tr>
        <tr>
            <th scope="row">PO Amount</th>
            <td>
                <input class="form-control" type="text" value="" name="po_amount">
            </td>
        </tr>
        <tr>
            <th scope="row">Invoice Number</th>
            <td>
                <input class="form-control" type="text" value="" name="invoice_number">
            </td>
        </tr>
        <tr>
            <th scope="row">Invoice Date</th>
            <td>
                <input class="form-control" type="date" value="" name="invoice_date">
            </td>
        </tr>
        <tr>
            <th scope="row">Invoice Amount</th>
            <td>
                <input class="form-control" type="text" value="" name="invoice_amount">
            </td>
        </tr>
        </tbody>
    </table>
</form>


<!-- Modal -->
<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="confirmation-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmation-modal-label">Are you sure you want to save changes?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Changes cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-outline-success" form="edit-values" id="confirmation-save-button">Save changes</button>
            </div>
        </div>
    </div>
</div>
EOT;
?>
</div>