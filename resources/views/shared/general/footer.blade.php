</div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Developed by : Estimasi Biaya Team
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    @if (session('message'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: "{{ session('title') }}",
                    text: "{{ session('message') }}",
                    icon: "{{ session('ikon') }}",
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    <!-- jQuery -->
    <script src="{{ asset('assets/vendorsadmin/jquery/dist/jquery.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('assets/vendorsadmin/select2/dist/js/select2.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendorsadmin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/vendorsadmin/nprogress/nprogress.js') }}"></script>
    <script
        src="{{ asset('assets/vendorsadmin/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('assets/vendorsadmin/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/morris.js/morris.min.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('assets/vendorsadmin/DateJS/build/date.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('assets/vendorsadmin/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets/vendorsadmin/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    <script src="{{ asset('assets/vendorsadmin/node_modules/xlsx/dist/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendorsadmin/node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/buildadmin/js/custom.min.js') }}"></script>

    <script src="{{ asset('assets/vendorsadmin/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>


    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/3.0.0/js/select.dataTables.js"></script> --}}

    <script>
        // Function to update the date and time
        function updateDateTime() {
            var now = new Date();
            var options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            $('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
        }
        
        // Update the date and time on page load
        updateDateTime();
        
        // Update the date and time every second
        setInterval(updateDateTime, 1000);
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>
</html>
<!-- Global Javascript -->
<script>
    var dataTable;
    $(document).ready(function () {
        dataTable = $("#datatable-fixed-header").DataTable({
            fixedHeader: true,
            searching: true,
            scrollX: true,
        });
    });

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function resetForm() {
        $('form')[0].reset();
    }

    function hapus(id, url) {
        Swal.fire({
            title: 'Delete Confirmation',
            text: 'Are you sure you want to delete this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const token = $('meta[name="csrf-token"]').attr('content');

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'An error occurred while contacting the server',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    });
            }
        });
    }

    function updateStatus(checkbox, status, id, url) {
        Swal.fire({
            title: 'Status Confirmation',
            text: 'Are you sure you want to change the status?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const token = $('meta[name="csrf-token"]').attr('content');

                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id,
                        status: status
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'An error occurred while contacting the server',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                        }).then((result) => {
                            if (result.isConfirmed || result.dismiss) {
                                location.reload();
                            }
                        });
                    });
            } else {
                // If user selects "Cancel", revert checkbox to original state
                setTimeout(function () {
                    checkbox.checked = !checkbox.checked;
                }, 0);
            }
        });
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            search();
        }
    }

    function reset() {
        location.reload();
    }

    function checkMaxLength(input, maxLength) {
        // Check if the input starts with a plus sign
        var hasPlusSign = input.value.startsWith('+');

        // Remove non-digit characters (excluding the plus sign)
        var sanitizedValue = input.value.replace(/\D/g, '');

        // Truncate the value to the maximum length
        var truncatedValue = sanitizedValue.slice(0, maxLength);

        // Add the plus sign back if it was originally present
        input.value = (hasPlusSign ? '+' : '') + truncatedValue;
    }

    function showDelayedAlert(timerset) {
        let timerInterval;
        Swal.fire({
            title: "System Processing!",
            html: "Please wait while processing...",
            allowOutsideClick: false,
            showCloseButton: false,
            didOpen: () => {
                Swal.showLoading();
                setTimeout(() => {
                    Swal.close();
                }, timerset);
            },
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
    }

    function alertnormal(title, message, icon) {
        Swal.fire({
            title: title,
            text: message,
            icon: icon,
            confirmButtonText: 'OK',
            timer: 5000,
            timerProgressBar: true,
        });
    }
</script>

<script>
    function updateTime() {
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        const now = new Date();
        const day = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');

        const suffix = getOrdinalSuffix(date);
        const formattedDateTime = `${day}, ${month} ${date}${suffix}, ${year}`;

        $('currentDateTime').innerText = formattedDateTime;
    }

    function getOrdinalSuffix(day) {
        if (day === 1 || day === 21 || day === 31) {
            return 'st';
        } else if (day === 2 || day === 22) {
            return 'nd';
        } else if (day === 3 || day === 23) {
            return 'rd';
        } else {
            return 'th';
        }
    }
    
    $(document).ready(function() {
        updateTime();
    });
</script>
</html>