<?php
if(isset($_GET["row"]))
{
    $edit_row = $_GET["row"];
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

    $row_row = $_POST['row_id'];
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
            
            WHERE id='$row_row'");
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
    $stmt = $conn->prepare("SELECT * FROM capex_tracking WHERE id='$edit_row' ");
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
        <form method="POST" action="" id="edit-values">        
            <input type="hidden" name="row_id" value="$row[id]">
            <div class="form-group row">
                <label class="col-1 col-form-label" for="project"><strong>Project</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[project]" name="project" id="project" autofocus>
                    <div id="initial-text">$row[project]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Status</strong></label>
                <div class="col-3">
                    <select class="form-control" name="status">
                      <option selected>Approved</option>
                      <option>Planned</option>
                    </select>
                    <div id="initial-text">$row[status]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Vendor</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[vendor]" name="vendor">
                    <div id="initial-text">$row[vendor]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Project Manager</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[project_manager]" name="project_manager">
                    <div id="initial-text">$row[project_manager]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>APR</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[apr]" name="apr">
                    <div id="initial-text">$row[apr]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>IP Code</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[ip_code]" name="ip_code">
                    <div id="initial-text">$row[ip_code]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Capex Total Amount</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[capex_total_amount]" name="capex_total_amount">
                    <div id="initial-text">$row[capex_total_amount]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>PO</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[po]" name="po">
                    <div id="initial-text">$row[po]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>PO Amount</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[po_amount]" name="po_amount">
                    <div id="initial-text">$row[po_amount]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Invoice Number</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[invoice_number]" name="invoice_number">
                    <div id="initial-text">$row[invoice_number]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Invoice Date</strong></label>
                <div class="col-3">
                    <input class="form-control" type="date" value="$row[invoice_date]" name="invoice_date">
                    <div id="initial-text">$row[invoice_date]</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label"><strong>Invoice Amount</strong></label>
                <div class="col-3">
                    <input class="form-control" type="text" value="$row[invoice_amount]" name="invoice_amount">
                    <div id="initial-text">$row[invoice_amount]</div>
                </div>
            </div>
        </form>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmation-modal" id="save-button">Save</button>
        <button type="button" class="btn btn-primary" id="edit-button">Edit</button>
        <button type="button" class="btn btn-danger" id="go-back-button">Back to view all</button>
        <button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
        
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" form="edit-values" id="confirmation-save-button">Save changes</button>
              </div>
            </div>
          </div>
        </div>
EOT;
}
?>
</div>