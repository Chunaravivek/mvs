<?php $this->append('allcss'); ?>
<link rel="stylesheet" href="<?php echo $BASEURL ?>assets/css/jquery-ui-1.10.3.full.min.css" />
<link rel="stylesheet" href="<?php echo $BASEURL ?>assets/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo $BASEURL ?>assets/css/ui.jqgrid.css" />
<link rel="stylesheet" href="<?php echo $BASEURL ?>assets/css/chosen.min.css" />
<?php $this->end(); ?>
<style type="text/css">
    .ui-jqgrid-bdiv
    {
        overflow-x : hidden !important;
    }

    th.ui-state-default.ui-th-column.ui-th-ltr {
        text-align: center !important;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="page-header">
            <h1>
                Cities
                <small>
                    <i class="icon-double-angle-right"></i>
                    All Cities
                </small>
            </h1>
        </div><!-- /.page-header -->
        
        <div class="well">
            <select class="col-xs-2 chosen-select" id="form-field-select-3" data-placeholder="Choose a Country...">
                <option value="">-- SELECT Area -- </option>
                <option value="1">City</option>
                <option value="2">State</option>
                <option value="3">Country</option>
            </select>
            
            
        </div>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <?php echo $this->Session->flash(); ?>
                <table id="grid-table"></table>

                <div id="grid-pager"></div>

                <script type="text/javascript">
                    var $path_base = "/";//this will be used in gritter alerts containing images
                </script>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div><!-- /.main-content -->
<?php $this->append('page_specific_js'); ?>
<!-- page specific plugin scripts -->
<script src="<?php echo $BASEURL ?>assets/js/jquery.tablednd.js"></script>
<script src="<?php echo $BASEURL ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $BASEURL ?>assets/js/jqGrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo $BASEURL ?>assets/js/jqGrid/i18n/grid.locale-en.js"></script>
<script src="<?php echo $BASEURL ?>assets/js/chosen.jquery.min.js"></script>

<?php $this->end(); ?>		
<?php $this->append('inline_specific_js'); ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
                    jQuery(function ($) {
                        var grid_selector = "#grid-table";
                        var pager_selector = "#grid-pager";
                        getColumnIndexByName = function (grid, columnName) {
                            var cm = grid.jqGrid('getGridParam', 'colModel'), i, l;
                            for (i = 0, l = cm.length; i < l; i += 1) {
                                if (cm[i].name === columnName) {
                                    return i; // return the index
                                }
                            }
                            return -1;
                        };
                        jQuery(grid_selector).jqGrid({
                            //direction: "rtl",
                            //data: grid_data,
                            url: 'Cities/records',
                            datatype: "json",
                            height: 'auto',
                            colNames: [' ', 'Name', 'Types'  ,'Created Date', 'Modified Date', 'status'],
                            colModel: [
                                {name: 'myac', index: '', width: 70, align: 'center', fixed: true, sortable: false, resize: false,
                                    formatter: 'actions',
                                    formatoptions: {
                                        keys: true,
                                        delOptions: {recreateForm: true, beforeShowForm: beforeDeleteCallback},
                                        //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
                                    }
                                },
                                {name: 'name', index: 'name', width: 80, align: 'center', editable: false, edittype: "text", editoptions: {required: true}},
                                {name: 'type_id', index: 'type_id', width: 50, editable: false, editoptions: {value: "1:City;2:State;3:Country"}, formatter: checkboxFormatters, formatoptions: {disabled: false}, sortable: false},
                                {name: 'created_date', index: 'created_date', align: 'center', width: 80, editable: false},
                                {name: 'modified_date', index: 'modified_date', align: 'center', width: 80, editable: false},
                                {name: 'status', index: 'status', width: 70, editable: false,editoptions: { value: "1:2" },formatter: checkboxFormatter,formatoptions: { disabled: false },sortable: false}
                            ],
                            viewrecords: true,
                            rowNum: 30,
                            rowList: [10, 20, 30, 50, 100],
                            pager: pager_selector,
                            altRows: true,
                            //toppager: true,

                            multiselect: true,
                            //multikey: "ctrlAd",
                            multiboxonly: true,
                            editurl: "Cities/inline",
                            caption: "Cities",
                            autowidth: true,
                            sortable: true,
                            loadComplete: function () {
                                var iCol = getColumnIndexByName($(this), 'status'), rows = this.rows, i, c = rows.length;
                                for (i = 0; i < c; i += 1) {
                                    $(rows[i].cells[iCol]).click(function (e) {
                                        var id = $(e.target).closest('tr')[0].id, isChecked = $(e.target).is(':checked');
                                        var status_val = 2;
                                        //you can also get the values of the row data
                                        if(isChecked) {
                                            status_val=1;
                                        }
                                        $.ajax({
                                            type: 'POST',
                                            url: 'Cities/update_status',
                                            data: { 
                                                'id': id,'status_val':status_val, 
                                            },
                                            success: function(msg){
                                            }
                                        });
                                    });
                                }
                            }

                        });
                        function imageUnFormat(cellvalue, options, cell) {
                            return '<img height="60" width="60" src="' + cellvalue + '" />';
                        }
                        //enable search/filter toolbar
                        //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
                        function checkboxFormatter(cellvalue, options, rowObject, rowid) {
                            var checked = '';
                            if(cellvalue == '1')
                            {
                                checked = "checked='checked'";
                            }
                            return "<label style='margin:0 0 0 -130px'>\
                                    <input type='checkbox' "+checked+" class='ace ace-switch ace-switch-3' value='"+cellvalue+"'><span class='lbl'></span></label>";
                        }
                        
                        function checkboxFormatters(cellvalue, options, rowObject, rowid) {
//                            var checked = '';
                            if (cellvalue == '1')
                            {
                               return "<label style='margin:0 0 0 30px'>City</label>";
                            } else if (cellvalue == '2') {
                                return "<label style='margin:0 0 0 30px'>State</label>";
                            } else {
                                return "<label style='margin:0 0 0 30px'>Country</label>";
                            }
                            
                        }


                        //navButtons
                        jQuery(grid_selector).jqGrid('navGrid', pager_selector,
                                {//navbar options
                                    edit: false,
                                    editicon: 'icon-pencil blue',
                                    add: false,
                                    addicon: 'icon-plus-sign purple',
                                    del: true,
                                    delicon: 'icon-trash red',
                                    search: true,
                                    searchicon: 'icon-search orange',
                                    refresh: true,
                                    refreshicon: 'icon-refresh green',
                                    view: false,
                                    viewicon: 'icon-zoom-in grey',
                                },
                                {
                                    //edit record form
                                    //closeAfterEdit: true,
                                    recreateForm: true,
                                    beforeShowForm: function (e) {
                                        var form = $(e[0]);
                                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                        alert(4);
                                        console.log(form);
                                        return false;
                                        window.location.href = "Cities/";
                                        style_edit_form(form);
                                    }
                                },
                                {
                                    //new record form
                                    closeAfterAdd: true,
                                    recreateForm: true,
                                    viewPagerButtons: false,
                                    beforeShowForm: function (e) {
                                        var form = $(e[0]);
                                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                        alert(3);
                                        style_edit_form(form);
                                    }
                                },
                                {
                                    //delete record form
                                    recreateForm: true,
                                    beforeShowForm: function (e) {
                                        var form = $(e[0]);
                                        if (form.data('styled'))
                                            return false;

                                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                        style_delete_form(form);

                                        form.data('styled', true);
                                    },
                                    onClick: function (e) {
                                        alert(1);
                                    }
                                },
                                {
                                    //search form
                                    recreateForm: true,
                                    afterShowSearch: function (e) {
                                        var form = $(e[0]);
                                        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                                        style_search_form(form);
                                    },
                                    afterRedraw: function () {
                                        style_search_filters($(this));
                                    }
                                    ,
                                    multipleSearch: true,
                                    /**
                                     multipleGroup:true,
                                     showQuery: true
                                     */
                                },
                                {
                                    //view record form
                                    recreateForm: true,
                                    beforeShowForm: function (e) {
                                        var form = $(e[0]);
                                        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                                    }
                                }
                        )
                                .navButtonAdd(pager_selector, {// custom add button
                                    caption: "",
                                    buttonicon: "icon-pencil blue",
                                    onClickButton: function () {
                                        var grid = $("#grid-table"); // ur jqgrid "#grid-table"
                                        //console.log(grid);
                                        var rowid = grid.jqGrid('getGridParam', 'selrow'); // get the selected rowid
                                        //console.log(rowid);
                                        //console.log(isNaN(rowid));
                                        // u can get the cell value of the row by 
                                        // grid.jqGrid('getCell', rowid, 'rowName');

                                        if (rowid != '' && rowid != null && isNaN(rowid) == false) {
                                            window.location = 'Cities/edit/' + rowid;
                                        }
                                    },
                                    position: "first"
                                })
                                .navButtonAdd(pager_selector, {// custom add button
                                    caption: "",
                                    buttonicon: "icon-plus-sign purple",
                                    onClickButton: function () {
                                        var grid = $("#grid-table"); // ur jqgrid "#grid-table"
                                        //console.log(grid);
                                        var rowid = grid.jqGrid('getGridParam', 'selrow'); // get the selected rowid
                                        //console.log(rowid);
                                        //console.log(isNaN(rowid));
                                        // u can get the cell value of the row by 
                                        // grid.jqGrid('getCell', rowid, 'rowName');

                                        if (1 == 1) {
                                            window.location = 'Cities/add';
                                        }
                                    },
                                    position: "first"
                                })


                        function style_edit_form(form) {
                            alert(1);
                            //enable datepicker on "sdate" field and switches for "stock" field
                            form.find('input[name=sdate]').datepicker({format: 'yyyy-mm-dd', autoclose: true})
                                    .end().find('input[name=stock]')
                                    .addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

                            //update buttons classes
                            var buttons = form.next().find('.EditButton .fm-button');
                            buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
                            buttons.eq(0).addClass('btn-primary').prepend('<i class="icon-ok"></i>');
                            buttons.eq(1).prepend('<i class="icon-remove"></i>')

                            buttons = form.next().find('.navButton a');
                            buttons.find('.ui-icon').remove();
                            buttons.eq(0).append('<i class="icon-chevron-left"></i>');
                            buttons.eq(1).append('<i class="icon-chevron-right"></i>');
                        }

                        function style_delete_form(form) {
                            var buttons = form.next().find('.EditButton .fm-button');
                            buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
                            buttons.eq(0).addClass('btn-danger').prepend('<i class="icon-trash"></i>');
                            buttons.eq(1).prepend('<i class="icon-remove"></i>')
                        }

                        function style_search_filters(form) {
                            form.find('.delete-rule').val('X');
                            form.find('.add-rule').addClass('btn btn-xs btn-primary');
                            form.find('.add-group').addClass('btn btn-xs btn-success');
                            form.find('.delete-group').addClass('btn btn-xs btn-danger');
                        }
                        function style_search_form(form) {
                            var dialog = form.closest('.ui-jqdialog');
                            var buttons = dialog.find('.EditTable')
                            buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'icon-retweet');
                            buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'icon-comment-alt');
                            buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'icon-search');
                        }

                        function beforeDeleteCallback(e) {
                            var form = $(e[0]);
                            if (form.data('styled'))
                                return false;

                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                            style_delete_form(form);

                            form.data('styled', true);
                        }

                        function beforeEditCallback(e) {
                            var form = $(e[0]);
                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                            alert(2);
                            style_edit_form(form);
                        }



                        //it causes some flicker when reloading or navigating grid
                        //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
                        //or go back to default browser checkbox styles for the grid
                        function styleCheckbox(table) {
                            /**
                             $(table).find('input:checkbox').addClass('ace')
                             .wrap('<label />')
                             .after('<span class="lbl align-top" />')
                             
                             
                             $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
                             .find('input.cbox[type=checkbox]').addClass('ace')
                             .wrap('<label />').after('<span class="lbl align-top" />');
                             */
                        }


                        //unlike navButtons icons, action icons in rows seem to be hard-coded
                        //you can change them like this in here if you want
                        function updateActionIcons(table) {
                            /**
                             var replacement = 
                             {
                             'ui-icon-pencil' : 'icon-pencil blue',
                             'ui-icon-trash' : 'icon-trash red',
                             'ui-icon-disk' : 'icon-ok green',
                             'ui-icon-cancel' : 'icon-remove red'
                             };
                             $(table).find('.ui-pg-div span.ui-icon').each(function(){
                             var icon = $(this);
                             var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                             if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                             })
                             */
                        }

                        //replace icons with FontAwesome icons like above
                        function updatePagerIcons(table) {
                            var replacement =
                                    {
                                        'ui-icon-seek-first': 'icon-double-angle-left bigger-140',
                                        'ui-icon-seek-prev': 'icon-angle-left bigger-140',
                                        'ui-icon-seek-next': 'icon-angle-right bigger-140',
                                        'ui-icon-seek-end': 'icon-double-angle-right bigger-140'
                                    };
                            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
                                var icon = $(this);
                                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                                if ($class in replacement)
                                    icon.attr('class', 'ui-icon ' + replacement[$class]);
                            })
                        }

                        function enableTooltips(table) {
                            $('.navtable .ui-pg-button').tooltip({container: 'body'});
                            $(table).find('.ui-pg-div').tooltip({container: 'body'});
                        }

                        function product_search() {
                            var types = $("#form-field-select-3").val().trim();

                            var passparams = "Cities/records?type_id=" + types;
                            var grid = $("#grid-table");
                            grid.jqGrid('setGridParam', {url: passparams, datatype: "json"}).trigger("reloadGrid");
                        }
                        //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
                        $("#form-field-select-3").change(function () { //alert(11);
                            product_search();
                        });

                        //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

                    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen();

    });
</script>
<?php $this->end(); ?>
