<?php
if(isset($_GET["row"]))
{
    $row_id = $_GET["row"];
}

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
        $stmt = $conn->prepare("UPDATE capex_tracking SET 
            project='$project',
            status='$status',
            vendor='$vendor',
            project_manager='$project_manager',
            apr='$apr',
            ip_code='$ip_code',
            capex_total_amount='$capex_total_amount',
            po='$po',
            po_amount='$po_amount',
            invoice_number='$invoice_number',
            invoice_date='$invoice_date',
            invoice_amount='$invoice_amount'
            
            WHERE id='$row_id'");
        $stmt->execute();

        header('Location: ?p=view_all');
    }
    catch(PDOException $e)

    {
        echo "Could not save, here's why: " . $e->getMessage();
    }
}

try {

    $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM capex_tracking WHERE id='$row_id' ");
    $stmt->execute();

    $result = $stmt-> fetchAll(PDO::FETCH_BOTH);

}
catch(PDOException $e)

{
    echo "Connection failed: " . $e->getMessage();
}
?>
<div class="container-fluid">
<?php
foreach( $result as $row ) {
    echo <<<EOT
<!-- Button trigger modal -->
<div class="text-center" id="top-buttons">
    <button type="button" class="btn btn-outline-primary hidden-print" id="print-button">Print</button>
    <button type="button" class="btn btn-outline-success hidden-print" data-toggle="modal" data-target="#confirmation-modal" id="save-button">Save</button>
    <button type="button" class="btn btn-outline-primary hidden-print" id="edit-button">Edit</button>
    <button type="button" class="btn btn-outline-danger hidden-print" id="go-back-button">Go Back</button>
    <button type="button" class="btn btn-outline-danger hidden-print" id="cancel-button">Cancel</button>
</div>
<div class="formss">
    <form method="POST" action="" id="edit-values">
        <table class="table table-striped display">
            <tbody>
                <tr>
                    <th scope="row">Project</th>
                    <td>
                        <div class="initial-text">$row[project]</div>
                        <input class="form-control view-input" type="text" value="$row[project]" name="project" id="project" autofocus>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>
                        <div class="initial-text">$row[status]</div>
                        <select class="form-control view-input" name="status">
                            <option selected>Approved</option>
                            <option>Planned</option>
                            <option>Closed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Vendor</th>
                    <td>
                        <div class="initial-text">$row[vendor]</div>
                        <input class="form-control view-input" type="text" value="$row[vendor]" name="vendor">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Project Manager</th>
                    <td>
                        <div class="initial-text">$row[project_manager]</div>
                        <input class="form-control view-input" type="text" value="$row[project_manager]" name="project_manager">
                    </td>
                </tr>
                <tr>
                    <th scope="row">APR</th>
                    <td>
                        <div class="initial-text">$row[apr]</div>
                        <input class="form-control view-input" type="text" value="$row[apr]" name="apr">
                    </td>
                </tr>
                <tr>
                    <th scope="row">IP Code</th>
                    <td>
                        <div class="initial-text">$row[ip_code]</div>
                        <input class="form-control view-input" type="text" value="$row[ip_code]" name="ip_code">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Capex Total Amount</th>
                    <td>
                        <div class="initial-text">$row[capex_total_amount]</div>
                        <input class="form-control view-input" type="text" value="$row[capex_total_amount]" name="capex_total_amount">
                    </td>
                </tr>
                <tr>
                    <th scope="row">PO</th>
                    <td>
                        <div class="initial-text">$row[po]</div>
                        <input class="form-control view-input" type="text" value="$row[po]" name="po">
                    </td>
                </tr>
                <tr>
                    <th scope="row">PO Amount</th>
                    <td>
                        <div class="initial-text">$row[po_amount]</div>
                        <input class="form-control view-input" type="text" value="$row[po_amount]" name="po_amount">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Invoice Number</th>
                    <td>
                        <div class="initial-text">$row[invoice_number]</div>
                        <input class="form-control view-input" type="text" value="$row[invoice_number]" name="invoice_number">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Invoice Date</th>
                    <td>
                        <div class="initial-text">$row[invoice_date]</div>
                        <input class="form-control view-input" type="date" value="$row[invoice_date]" name="invoice_date">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Invoice Amount</th>
                    <td>
                        <div class="initial-text">$row[invoice_amount]</div>
                        <input class="form-control view-input" type="text" value="$row[invoice_amount]" name="invoice_amount">
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
            <p>Changes cannot be undone.</p>
            <div id="changes-made"></div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="confirmation-cancel-button">Cancel</button>
            <button type="submit" class="btn btn-outline-success" form="edit-values" id="confirmation-save-button">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</div>
EOT;
}
?>
</div>