<!-- <style>
    .pagination li a {
        padding: .375rem .75rem;
        border-radius: 30px!important;
        margin: 0 3px!important;
        border: none;
    }
    .pagination li.active a{
        z-index: 3;
        color: #fff;
        background-color: #727cf5;
        border-color: #727cf5;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite"><? //echo $this->Paginator->counter(['format' => (__('pagination_page') . ' {{page}}' . __('pagination_of') . ' {{pages}} ' . __('pagination_showing') . ' {{current}} ' . __('pagination_record') . ' {{count}} ' . __('pagination_total'))]) ?></div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
            <ul class="pagination pagination-rounded">
                
                <? //echo $this->Paginator->prev('< ') ?>
                <? //echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));?>
                <? //echo $this->Paginator->next(' >') ?>
            </ul>
        </div>
    </div>
</div> -->


 <div class="paginator">
    <ul class="pagination">
        <?php echo $this->Paginator->first('<< ' . __('first')) ?>
        <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
        <?php echo $this->Paginator->numbers() ?>
        <?php echo $this->Paginator->next(__('next') . ' >') ?>
        <?php echo $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?php echo $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, motrando {{current}} registro(s) de um total de {{count}}')]) ?></p>
</div>