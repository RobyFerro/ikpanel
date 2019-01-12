import SimpleGui from '../../../../../../../resources/assets/js/modules/simple-gui';

const SGui = new SimpleGui();

// Impostazioni generali
SGui.table = '#candidacy-step-table';
SGui.searchFilter = '#search-filter';
SGui.statusFilter = '#status-filter';
SGui.filterUrlPrefix = 'candidacy-step';
SGui.itemInTable = -1;
SGui.resultContainer = '#candidacy-step-table';
SGui.saveOrder = true;
SGui.sort = false;

// Pulsanti azione
SGui.actionButtonRestore = '.action-restore';
SGui.actionButtonDelete = '.action-delete';

// Messaggi eliminazione
SGui.actionDeleteMessage = 'Sto eliminando lo step selezionato... ';
SGui.actionDeleteQuestion = 'Sei sicuro di voler eliminare lo step selezionato? ';

// Messaggi ripristino
SGui.actionRestoreMessage = 'Sto ripristinando lo step selezionato...';
SGui.actionRestoreQuestion = 'Sei sicuro di voler ripristinare lo step selezionato?';

// Attivo lo script
SGui.init();