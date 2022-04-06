<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';
?>
<!-- BEGIN: Content-->
    <div class="app-content content todo-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content todo-sidebar">
                        <div class="todo-app-menu">
                            <div class="add-task">
                                <div class="mt-1 px-2 d-flex justify-content-between">
                                    <h4 class="section-label"><b>List Pesanan</b></h4>
                                    <i data-feather="list" class="cursor-pointer"></i>
                                </div>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-filters">
                                    <?php
                                        // Get data pesanan
                                        $query_pesanan = "SELECT id,judul,pelayanan,status_pesanan FROM pesanan WHERE id_brand='".$id_brand."'";
                                        if($id_branch!="" || $id_branch!=0){
                                            $query_pesanan.=" AND id_branch='".$id_branch."'";
                                        }
                                        $data_pesanan = $koneksi->prepare($query_pesanan);
                                        $data_pesanan->execute();
                                        $data_pesanan->bind_result($id_pesanan,$nama_pelanggan,$pelayanan,$status_pemesanan);
                                        while($data_pesanan->fetch()){
                                            $status = "";
                                            $badge = "";
                                            if($pelayanan!=0 && $status_pemesanan!=0){
                                                $status = "Transaksi Selesai";
                                                $badge = "bg-primary";
                                            }else if($pelayanan==0 && $status_pemesanan==1){
                                                $status = "Belum dilayani";
                                                $badge = "bg-warning";
                                            }else if($pelayanan==1 && $status_pemesanan==0){
                                                $status_pemesanan = "Belum ada pembayaran";
                                                $badge = "bg-warning";
                                            }else{
                                                $status = "Transaksi belum di proses";
                                                $badge = "bg-danger";
                                            }
                                    ?>
                                    <a class="list-group-item list-group-item-action list_pesanan" data-id_pesanan="<?php echo $id_pesanan; ?>">
                                        <i data-feather="file-text" class="font-medium-3 me-50"></i>
                                        <span class="align-middle"><?php echo $nama_pelanggan; ?></span>
                                        <span class="badge <?php echo $badge; ?>"><?php echo $status; ?></span>
                                    </a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <div class="todo-app-list">
                            <!-- Todo search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ms-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                        <input type="text" class="form-control todo-search" placeholder="Cari pesanan" aria-label="Search..." aria-describedby="todo-search" />
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle hide-arrow me-1" id="todoActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="todoActions">
                                        <a class="dropdown-item sort-asc" href="#">Sort A - Z</a>
                                        <a class="dropdown-item sort-desc" href="#">Sort Z - A</a>
                                        <a class="dropdown-item" href="#">Sort Assignee</a>
                                        <a class="dropdown-item" href="#">Sort Due Date</a>
                                        <a class="dropdown-item" href="#">Sort Today</a>
                                        <a class="dropdown-item" href="#">Sort 1 Week</a>
                                        <a class="dropdown-item" href="#">Sort 1 Month</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Todo search ends -->

                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                                <ul class="todo-task-list media-list todo-task-list">
                                </ul>
                                <div class="no-results">
                                    <h5>Pesanan tidak ditemukan</h5>
                                </div>
                            </div>
                            <!-- Todo List ends -->
                        </div>

                        <!-- Right Sidebar starts -->
                        <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                                        <div class="modal-header align-items-center mb-1">
                                            <h5 class="modal-title">Add Task</h5>
                                            <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
                                                <span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star" class="font-medium-2"></i></span>
                                                <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                            <div class="action-tags">
                                                <div class="mb-1">
                                                    <label for="todoTitleAdd" class="form-label">Title</label>
                                                    <input type="text" id="todoTitleAdd" name="todoTitleAdd" class="new-todo-item-title form-control" placeholder="Title" />
                                                </div>
                                                <div class="mb-1 position-relative">
                                                    <label for="task-assigned" class="form-label d-block">Assignee</label>
                                                    <select class="select2 form-select" id="task-assigned" name="task-assigned">
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-3.jpg" value="Phill Buffer" selected>
                                                            Phill Buffer
                                                        </option>
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-1.jpg" value="Chandler Bing">
                                                            Chandler Bing
                                                        </option>
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-4.jpg" value="Ross Geller">
                                                            Ross Geller
                                                        </option>
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-6.jpg" value="Monica Geller">
                                                            Monica Geller
                                                        </option>
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-2.jpg" value="Joey Tribbiani">
                                                            Joey Tribbiani
                                                        </option>
                                                        <option data-img="../assets/tema/template/app-assets/images/portrait/small/avatar-s-11.jpg" value="Rachel Green">
                                                            Rachel Green
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="task-due-date" class="form-label">Due Date</label>
                                                    <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                                                </div>
                                                <div class="mb-1">
                                                    <label for="task-tag" class="form-label d-block">Tag</label>
                                                    <select class="form-select task-tag" id="task-tag" name="task-tag" multiple="multiple">
                                                        <option value="Team">Team</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                        <option value="Update">Update</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label">Description</label>
                                                    <div id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description"></div>
                                                    <div class="d-flex justify-content-end desc-toolbar border-top-0">
                                                        <span class="ql-formats me-0">
                                                            <button class="ql-bold"></button>
                                                            <button class="ql-italic"></button>
                                                            <button class="ql-underline"></button>
                                                            <button class="ql-align"></button>
                                                            <button class="ql-link"></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-1">
                                                <button type="submit" class="btn btn-primary d-none add-todo-item me-1">Add</button>
                                                <button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="button" class="btn btn-primary d-none update-btn update-todo-item me-1">Update</button>
                                                <button type="button" class="btn btn-outline-danger update-btn d-none" data-bs-dismiss="modal">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
        include 'footer.php';
    ?>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/extensions/dragula.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        $(document).ready(function(){
            $(".update_pesanan").hide()

            $(".list_pesanan").click(function(){
                var no_pesan = $(this).data('id_pesanan');

                $.ajax({
                    url : 'pesanan_item.php',
                    method:"POST",
                    data : {id_pesanan:no_pesan},
                    success: function(hasil){
                        $('.todo-task-list').html(hasil);

                        $(".checklist").click(function(){
                            var id_pesanan_item = $(this).data('id_penjualan');
                            updatePesanan(id_pesanan_item);
                        });

                        var coba = $(".data_layanan").html();
                        console.log(coba);
                    }
                })
            });

            function updatePesanan(nilai){
                $.ajax({
                    url : 'proses/proses_update_pesanan.php',
                    method:"GET",
                    data : "id="+nilai,
                    success: function(hasil){
                        location.reload();
                    }
                })
            }
        });

        /*=========================================================================================
            File Name: app-todo.js
            Description: app-todo
            ----------------------------------------------------------------------------------------
            Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
            Author: PIXINVENT
            Author URL: http://www.themeforest.net/user/pixinvent
        ==========================================================================================*/

        'use strict';

        $(function () {
        var taskTitle,
            flatPickr = $('.task-due-date'),
            newTaskModal = $('.sidebar-todo-modal'),
            newTaskForm = $('#form-modal-todo'),
            favoriteStar = $('.todo-item-favorite'),
            modalTitle = $('.modal-title'),
            addBtn = $('.add-todo-item'),
            addTaskBtn = $('.add-task button'),
            updateTodoItem = $('.update-todo-item'),
            updateBtns = $('.update-btn'),
            taskDesc = $('#task-desc'),
            taskAssignSelect = $('#task-assigned'),
            taskTag = $('#task-tag'),
            overlay = $('.body-content-overlay'),
            menuToggle = $('.menu-toggle'),
            sidebarToggle = $('.sidebar-toggle'),
            sidebarLeft = $('.sidebar-left'),
            sidebarMenuList = $('.sidebar-menu-list'),
            todoFilter = $('.todo-search'),
            sortAsc = $('.sort-asc'),
            sortDesc = $('.sort-desc'),
            todoTaskList = $('.todo-task-list'),
            todoTaskListWrapper = $('.todo-task-list-wrapper'),
            listItemFilter = $('.list-group-filters'),
            noResults = $('.no-results'),
            checkboxId = 100,
            isRtl = $('html').attr('data-textdirection') === 'rtl';

        var assetPath = '../../../app-assets/';
        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
        }

        // if it is not touch device
        if (!$.app.menu.is_touch_device()) {
            if (sidebarMenuList.length > 0) {
            var sidebarListScrollbar = new PerfectScrollbar(sidebarMenuList[0], {
                theme: 'dark'
            });
            }
            if (todoTaskListWrapper.length > 0) {
            var taskListScrollbar = new PerfectScrollbar(todoTaskListWrapper[0], {
                theme: 'dark'
            });
            }
        }
        // if it is a touch device
        else {
            sidebarMenuList.css('overflow', 'scroll');
            todoTaskListWrapper.css('overflow', 'scroll');
        }

        // Add class active on click of sidebar filters list
        if (listItemFilter.length) {
            listItemFilter.find('a').on('click', function () {
            if (listItemFilter.find('a').hasClass('active')) {
                listItemFilter.find('a').removeClass('active');
            }
            $(this).addClass('active');
            });
        }

        // Init D'n'D
        var dndContainer = document.getElementById('todo-task-list');
        if (typeof dndContainer !== undefined && dndContainer !== null) {
            dragula([dndContainer], {
            moves: function (el, container, handle) {
                return handle.classList.contains('drag-icon');
            }
            });
        }

        // Main menu toggle should hide app menu
        if (menuToggle.length) {
            menuToggle.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            });
        }

        // Todo sidebar toggle
        if (sidebarToggle.length) {
            sidebarToggle.on('click', function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass('show');
            overlay.addClass('show');
            });
        }

        // On Overlay Click
        if (overlay.length) {
            overlay.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            $(newTaskModal).modal('hide');
            });
        }

        // Assign task
        function assignTask(option) {
            if (!option.id) {
            return option.text;
            }
            var $person =
            '<div class="d-flex align-items-center">' +
            '<img class="d-block rounded-circle me-50" src="' +
            $(option.element).data('img') +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<p class="mb-0">' +
            option.text +
            '</p></div>';

            return $person;
        }

        // Task Assign Select2
        if (taskAssignSelect.length) {
            taskAssignSelect.wrap('<div class="position-relative"></div>');
            taskAssignSelect.select2({
            placeholder: 'Unassigned',
            dropdownParent: taskAssignSelect.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            }
            });
        }

        // Task Tags
        if (taskTag.length) {
            taskTag.wrap('<div class="position-relative"></div>');
            taskTag.select2({
            placeholder: 'Select tag'
            });
        }

        // Favorite star click
        if (favoriteStar.length) {
            $(favoriteStar).on('click', function () {
            $(this).toggleClass('text-warning');
            });
        }

        // Flat Picker
        if (flatPickr.length) {
            flatPickr.flatpickr({
            dateFormat: 'Y-m-d',
            defaultDate: 'today',
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                $(instance.mobileInput).attr('step', null);
                }
            }
            });
        }

        // Todo Description Editor
        if (taskDesc.length) {
            var todoDescEditor = new Quill('#task-desc', {
            bounds: '#task-desc',
            modules: {
                formula: true,
                syntax: true,
                toolbar: '.desc-toolbar'
            },
            placeholder: 'Write Your Description',
            theme: 'snow'
            });
        }

        // On add new item button click, clear sidebar-right field fields
        if (addTaskBtn.length) {
            addTaskBtn.on('click', function (e) {
            addBtn.removeClass('d-none');
            updateBtns.addClass('d-none');
            modalTitle.text('Add Task');
            // newTaskModal.modal('show');
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            newTaskModal.find('.new-todo-item-title').val('');
            var quill_editor = taskDesc.find('.ql-editor');
            quill_editor[0].innerHTML = '';
            });
        }

        // Add New ToDo List Item

        // To add new todo form
        if (newTaskForm.length) {
            newTaskForm.validate({
            ignore: '.ql-container *', // ? ignoring quill editor icon click, that was creating console error
            rules: {
                todoTitleAdd: {
                required: true
                },
                'task-assigned': {
                required: true
                },
                'task-due-date': {
                required: true
                }
            }
            });

            newTaskForm.on('submit', function (e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                checkboxId++;
                var assignedTo = $('#task-assigned').val(),
                todoBadge = '',
                membersImg = {
                    'Phill Buffer': assetPath + 'images/portrait/small/avatar-s-3.jpg',
                    'Chandler Bing': assetPath + 'images/portrait/small/avatar-s-1.jpg',
                    'Ross Geller': assetPath + 'images/portrait/small/avatar-s-4.jpg',
                    'Monica Geller': assetPath + 'images/portrait/small/avatar-s-6.jpg',
                    'Joey Tribbiani': assetPath + 'images/portrait/small/avatar-s-2.jpg',
                    'Rachel Green': assetPath + 'images/portrait/small/avatar-s-11.jpg'
                };

                var todoTitle = $('.sidebar-todo-modal .new-todo-item-title').val();
                var date = $('.sidebar-todo-modal .task-due-date').val(),
                selectedDate = new Date(date),
                month = new Intl.DateTimeFormat('en', { month: 'short' }).format(selectedDate),
                day = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(selectedDate),
                todoDate = month + ' ' + day;

                // Badge calculation loop
                var selected = $('.task-tag').val();
                var badgeColor = {
                Team: 'primary',
                Low: 'success',
                Medium: 'warning',
                High: 'danger',
                Update: 'info'
                };
                $.each(selected, function (index, value) {
                todoBadge +=
                    '<span class="badge rounded-pill badge-light-' + badgeColor[value] + ' me-50">' + value + '</span>';
                });
                // HTML Output
                if (todoTitle != '') {
                $(todoTaskList).prepend(
                    '<li class="todo-item">' +
                    '<div class="todo-title-wrapper">' +
                    '<div class="todo-title-area">' +
                    feather.icons['more-vertical'].toSvg({ class: 'drag-icon' }) +
                    '<div class="title-wrapper">' +
                    '<div class="form-check">' +
                    '<input type="checkbox" class="form-check-input" id="customCheck' +
                    checkboxId +
                    '" />' +
                    '<label class="form-check-label" for="customCheck' +
                    checkboxId +
                    '"></label>' +
                    '</div>' +
                    '<span class="todo-title">' +
                    todoTitle +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="todo-item-action">' +
                    '<span class="badge-wrapper me-1">' +
                    todoBadge +
                    '</span>' +
                    '<small class="text-nowrap text-muted me-1">' +
                    todoDate +
                    '</small>' +
                    '<div class="avatar">' +
                    '<img src="' +
                    membersImg[assignedTo] +
                    '" alt="' +
                    assignedTo +
                    '" height="28" width="28">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>'
                );
                }
                toastr['success']('Data Saved', '💾 Task Action!', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
                });
                $(newTaskModal).modal('hide');
                overlay.removeClass('show');
            }
            });
        }

        // Task checkbox change
        todoTaskListWrapper.on('change', '.form-check', function (event) {
            var $this = $(this).find('input');
            if ($this.prop('checked')) {
            $this.closest('.todo-item').addClass('completed');
            toastr['success']('Task Completed', 'Congratulations!! 🎉', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
            });
            } else {
            $this.closest('.todo-item').removeClass('completed');
            }
        });
        todoTaskListWrapper.on('click', '.form-check', function (event) {
            event.stopPropagation();
        });

        // To open todo list item modal on click of item
        $(document).on('click', '.todo-task-list-wrapper .todo-item', function (e) {
            newTaskModal.modal('show');
            addBtn.addClass('d-none');
            updateBtns.removeClass('d-none');
            if ($(this).hasClass('completed')) {
            modalTitle.html(
                '<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-bs-dismiss="modal">Completed</button>'
            );
            } else {
            modalTitle.html(
                '<button type="button" class="btn btn-sm btn-outline-secondary complete-todo-item waves-effect waves-float waves-light" data-bs-dismiss="modal">Mark Complete</button>'
            );
            }
            taskTag.val('').trigger('change');
            var quill_editor = $('#task-desc .ql-editor'); // ? Dummy data as not connected with API or anything else
            quill_editor[0].innerHTML =
            'Chocolate cake topping bonbon jujubes donut sweet wafer. Marzipan gingerbread powder brownie bear claw. Chocolate bonbon sesame snaps jelly caramels oat cake.';
            taskTitle = $(this).find('.todo-title');
            var $title = $(this).find('.todo-title').html();

            // apply all variable values to fields
            newTaskForm.find('.new-todo-item-title').val($title);
        });

        // Updating Data Values to Fields
        if (updateTodoItem.length) {
            updateTodoItem.on('click', function (e) {
            var isValid = newTaskForm.valid();
            e.preventDefault();
            if (isValid) {
                var $edit_title = newTaskForm.find('.new-todo-item-title').val();
                $(taskTitle).text($edit_title);

                toastr['success']('Data Saved', '💾 Task Action!', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
                });
                $(newTaskModal).modal('hide');
            }
            });
        }

        // Sort Ascending
        if (sortAsc.length) {
            sortAsc.on('click', function () {
            todoTaskListWrapper
                .find('li')
                .sort(function (a, b) {
                return $(b).find('.todo-title').text().toUpperCase() < $(a).find('.todo-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
            });
        }
        // Sort Descending
        if (sortDesc.length) {
            sortDesc.on('click', function () {
            todoTaskListWrapper
                .find('li')
                .sort(function (a, b) {
                return $(b).find('.todo-title').text().toUpperCase() > $(a).find('.todo-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
            });
        }

        // Filter task
        if(todoFilter.length) {
            todoFilter.on('keyup', function () {
            var value = $(this).val().toLowerCase();
            if (value !== '') {
                $('.todo-item').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                var tbl_row = $('.todo-item:visible').length; //here tbl_test is table name

                //Check if table has row or not
                if (tbl_row == 0) {
                if (!$(noResults).hasClass('show')) {
                    $(noResults).addClass('show');
                }
                } else {
                $(noResults).removeClass('show');
                }
            } else {
                // If filter box is empty
                $('.todo-item').show();
                if ($(noResults).hasClass('show')) {
                $(noResults).removeClass('show');
                }
            }
            });
        }

        // For chat sidebar on small screen
        if ($(window).width() > 992) {
            if (overlay.hasClass('show')) {
            overlay.removeClass('show');
            }
        }
        });

        $(window).on('resize', function () {
        // remove show classes from sidebar and overlay if size is > 992
        if ($(window).width() > 992) {
            if ($('.body-content-overlay').hasClass('show')) {
            $('.sidebar-left').removeClass('show');
            $('.body-content-overlay').removeClass('show');
            $('.sidebar-todo-modal').modal('hide');
            }
        }
        });

    </script>
</body>
<!-- END: Body-->

</html>