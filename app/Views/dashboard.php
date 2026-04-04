<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

        
            <div class="row">

            <?php if (session()->get('role') === 'admin'): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalStaff ?? 0 ?></h3>
                            <p>Total Staff</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?= base_url('users') ?>" class="small-box-footer">
                            See More <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                  <?php endif; ?>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalProduct ?? 0 ?></h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cube"></i>
                        </div>
                        <a href="<?= base_url('product') ?>" class="small-box-footer">
                            See More <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

             
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>₱<?= number_format($totalSales ?? 0, 2) ?></h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                    </div>
                </div>
             

            </div>

         <?php if (session()->get('role') === 'admin'): ?>
            <div class="card mt-3" id="sales">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Sales Transactions</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Staff ID</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($salesList)): ?>
                                <?php foreach ($salesList as $sale): ?>
                                <tr>
                                    <td><?= $sale['id'] ?></td>
                                    <td><?= $sale['user_id'] ?></td>
                                    <td>₱<?= number_format($sale['total'], 2) ?></td>
                                    <td><?= $sale['date'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No sales found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
             </div>

             
            <?php endif; ?>

            

        </div>
    </section>


    

</div>

<?= $this->endSection() ?>