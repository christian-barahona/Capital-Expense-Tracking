<?php
try {

        $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM capex_tracking");
        $stmt->execute();

        $result = $stmt-> fetchAll(PDO::FETCH_BOTH);

}	
catch(PDOException $e)

    {
        echo "Database connection failed: " . $e->getMessage();
    }
?>
<div class="container-fluid">
    <div class="row">
        <table class="table table-striped table-hover" id="view-all">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Vendor</th>
                    <th>Project Manager</th>
                    <th>APR#</th>
                    <th>IP Code</th>
                    <th>CAPEX Total Amount</th>
                    <th>PO#</th>
                    <th>PO Amount</th>
                    <th>Invoice#</th>
                    <th>Invoice Date</th>
                    <th>Invoice Amount</th>
                    <th>PO Remaining</th>
                    <th>CAPEX Committed (PO)</th>
                    <th>CAPEX Remaining (PO)</th>
                </tr>
            </thead>
            <?php
            $row_counter = 0;
            foreach( $result as $row ) {
                $row_counter++;
                echo <<<EOT
                    <tr class="click-row" id="$row[id]"> 
                        <th scope='row'>$row_counter</th>
                        <td>$row[project]</td>
                        <td>$row[status]</td>
                        <td>$row[vendor]</td>
                        <td>$row[project_manager]</td>
                        <td>$row[apr]</td>
                        <td>$row[ip_code]</td>
                        <td>$row[capex_total_amount]</td>
                        <td>$row[po]</td>
                        <td>$row[po_amount]</td>
                        <td>$row[invoice_number]</td>
                        <td>$row[invoice_date]</td>
                        <td>$row[invoice_amount]</td>
                        <td>$row[po_remaining]</td>
                        <td>$row[capex_committed_po]</td>
                        <td>$row[capex_remaining_po]</td>
                    </tr>
EOT;
            }
?>
        </table>
    </div>
</div>