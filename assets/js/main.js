(function($) {
    'use strict';

    class CustomTableWidget {
        constructor() {
            this.init();
        }

        init() {
            // Initialize when DOM is ready
            $(document).ready(() => {
                this.initTables();
            });

            // Re-initialize when Elementor editor loads new content
            if (typeof elementorFrontend !== 'undefined') {
                elementorFrontend.hooks.addAction('frontend/element_ready/custom-table.default', (scope) => {
                    this.initSingleTable(scope);
                });
            }

            // Handle window resize
            $(window).on('resize', this.debounce(() => {
                this.handleResize();
            }, 250));
        }

        initTables() {
            $('.custom-table-container').each((index, element) => {
                this.initSingleTable($(element));
            });
        }

        initSingleTable($container) {
            const container = $container.hasClass('custom-table-container') ? 
                $container[0] : $container.find('.custom-table-container')[0];
            
            if (!container) return;

            // Add fade-in animation
            $(container).addClass('fade-in');

            // Initialize responsive behavior
            this.setupResponsiveBehavior(container);

            // Add keyboard navigation
            this.setupKeyboardNavigation(container);

            // Add sorting functionality (optional)
            this.setupSorting(container);

            // Add search functionality (optional)
            this.setupSearch(container);
        }

        setupResponsiveBehavior(container) {
            const breakpoint = parseInt(container.dataset.breakpoint) || 768;
            const desktopView = container.querySelector('.table-desktop');
            const mobileView = container.querySelector('.table-mobile');

            if (!desktopView || !mobileView) return;

            const handleResize = () => {
                const windowWidth = window.innerWidth;
                
                if (windowWidth <= breakpoint) {
                    desktopView.style.display = 'none';
                    mobileView.style.display = 'block';
                } else {
                    desktopView.style.display = 'block';
                    mobileView.style.display = 'none';
                }
            };

            // Initial check
            handleResize();

            // Store resize function for later use
            container._resizeHandler = handleResize;
        }

        setupKeyboardNavigation(container) {
            const table = container.querySelector('.custom-table');
            if (!table) return;

            // Make table focusable
            table.setAttribute('tabindex', '0');
            table.setAttribute('role', 'table');
            table.setAttribute('aria-label', 'Data table');

            // Add keyboard navigation for cells
            const cells = table.querySelectorAll('td, th');
            cells.forEach((cell, index) => {
                cell.setAttribute('tabindex', '-1');
                cell.addEventListener('keydown', (e) => {
                    this.handleCellKeydown(e, cells, index);
                });
            });

            // Focus first cell when table is focused
            table.addEventListener('focus', () => {
                const firstCell = table.querySelector('td, th');
                if (firstCell) {
                    firstCell.focus();
                }
            });
        }

        handleCellKeydown(e, cells, currentIndex) {
            const table = e.target.closest('table');
            const rows = table.querySelectorAll('tr');
            const currentRow = e.target.closest('tr');
            const currentRowIndex = Array.from(rows).indexOf(currentRow);
            const cellsInRow = currentRow.querySelectorAll('td, th');
            const currentCellIndex = Array.from(cellsInRow).indexOf(e.target);

            let targetCell = null;

            switch (e.key) {
                case 'ArrowRight':
                    targetCell = cellsInRow[currentCellIndex + 1];
                    break;
                case 'ArrowLeft':
                    targetCell = cellsInRow[currentCellIndex - 1];
                    break;
                case 'ArrowDown':
                    if (rows[currentRowIndex + 1]) {
                        const nextRowCells = rows[currentRowIndex + 1].querySelectorAll('td, th');
                        targetCell = nextRowCells[currentCellIndex];
                    }
                    break;
                case 'ArrowUp':
                    if (rows[currentRowIndex - 1]) {
                        const prevRowCells = rows[currentRowIndex - 1].querySelectorAll('td, th');
                        targetCell = prevRowCells[currentCellIndex];
                    }
                    break;
                case 'Home':
                    targetCell = cellsInRow[0];
                    e.preventDefault();
                    break;
                case 'End':
                    targetCell = cellsInRow[cellsInRow.length - 1];
                    e.preventDefault();
                    break;
            }

            if (targetCell) {
                targetCell.focus();
                e.preventDefault();
            }
        }

        setupSorting(container) {
            const table = container.querySelector('.custom-table');
            if (!table) return;

            const headers = table.querySelectorAll('thead th');
            
            headers.forEach((header, index) => {
                header.style.cursor = 'pointer';
                header.setAttribute('aria-sort', 'none');
                header.setAttribute('tabindex', '0');
                
                // Add sort indicator
                const sortIndicator = document.createElement('span');
                sortIndicator.className = 'sort-indicator';
                sortIndicator.innerHTML = ' ⇅';
                sortIndicator.style.opacity = '0.5';
                header.appendChild(sortIndicator);

                header.addEventListener('click', () => {
                    this.sortTable(table, index);
                });

                header.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.sortTable(table, index);
                    }
                });
            });
        }

        sortTable(table, columnIndex) {
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const header = table.querySelectorAll('thead th')[columnIndex];
            const currentSort = header.getAttribute('aria-sort');
            
            // Reset all headers
            table.querySelectorAll('thead th').forEach(th => {
                th.setAttribute('aria-sort', 'none');
                const indicator = th.querySelector('.sort-indicator');
                if (indicator) indicator.innerHTML = ' ⇅';
            });

            // Determine sort direction
            const isAscending = currentSort === 'none' || currentSort === 'descending';
            
            // Sort rows
            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();
                
                // Try to parse as numbers
                const aNum = parseFloat(aText);
                const bNum = parseFloat(bText);
                
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return isAscending ? aNum - bNum : bNum - aNum;
                } else {
                    return isAscending ? 
                        aText.localeCompare(bText) : 
                        bText.localeCompare(aText);
                }
            });

            // Update DOM
            rows.forEach(row => tbody.appendChild(row));

            // Update header
            header.setAttribute('aria-sort', isAscending ? 'ascending' : 'descending');
            const indicator = header.querySelector('.sort-indicator');
            if (indicator) {
                indicator.innerHTML = isAscending ? ' ▲' : ' ▼';
            }
        }

        setupSearch(container) {
            // This is optional - you can enable it by adding a search input
            const searchInput = container.querySelector('.table-search');
            if (!searchInput) return;

            searchInput.addEventListener('input', this.debounce((e) => {
                this.filterTable(container, e.target.value);
            }, 300));
        }

        filterTable(container, searchTerm) {
            const table = container.querySelector('.custom-table');
            const mobileCards = container.querySelectorAll('.table-card');
            
            if (!searchTerm) {
                // Show all rows/cards
                table?.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = '';
                });
                mobileCards.forEach(card => {
                    card.style.display = '';
                });
                return;
            }

            const term = searchTerm.toLowerCase();

            // Filter table rows
            if (table) {
                table.querySelectorAll('tbody tr').forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            }

            // Filter mobile cards
            mobileCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(term) ? '' : 'none';
            });
        }

        handleResize() {
            document.querySelectorAll('.custom-table-container').forEach(container => {
                if (container._resizeHandler) {
                    container._resizeHandler();
                }
            });
        }

        debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Utility method to add loading state
        showLoading(container) {
            $(container).addClass('loading');
        }

        hideLoading(container) {
            $(container).removeClass('loading');
        }

        // Method to export table data (optional enhancement)
        exportToCSV(container) {
            const table = container.querySelector('.custom-table');
            if (!table) return;

            let csv = [];
            const rows = table.querySelectorAll('tr');

            rows.forEach(row => {
                const cols = row.querySelectorAll('td, th');
                const rowData = Array.from(cols).map(col => 
                    '"' + col.textContent.replace(/"/g, '""') + '"'
                );
                csv.push(rowData.join(','));
            });

            const csvContent = csv.join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'table-data.csv';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    }

    // Initialize the widget
    new CustomTableWidget();

    // Expose to global scope for external access
    window.CustomTableWidget = CustomTableWidget;

})(jQuery);