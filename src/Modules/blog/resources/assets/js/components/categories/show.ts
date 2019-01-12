import SimpleGui from '../../../../../../../resources/assets/js/modules/simple-gui';

const SGui = new SimpleGui();

// General settings
SGui.table = '#blogCategoryTable';
SGui.searchFilter = '#search-filter';
SGui.statusFilter = '#status-filter';
SGui.filterUrlPrefix = 'mod/blog/categories';
SGui.itemInTable = -1;
SGui.resultContainer = '#blogCategoryTable';
SGui.saveOrder = true;
SGui.sort = true;

// Action buttons
SGui.actionButtonRestore = '.action-restore';
SGui.actionButtonDelete = '.action-delete';

// Delete messages
SGui.actionDeleteMessage = 'Sto eliminando lo step selezionato... ';
SGui.actionDeleteQuestion = 'Sei sicuro di voler eliminare lo step selezionato? ';

// Restore messages
SGui.actionRestoreMessage = 'Sto ripristinando lo step selezionato...';
SGui.actionRestoreQuestion = 'Sei sicuro di voler ripristinare lo step selezionato?';

// Start script
SGui.init();