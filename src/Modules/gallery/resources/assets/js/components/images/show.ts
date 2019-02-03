import SimpleGui from '@ikpanel/simple-gui';

const SGui = new SimpleGui();

// General settings
SGui.table = '#galleryImagesTable';
SGui.searchFilter = '#search-filter';
SGui.statusFilter = '#status-filter';
SGui.filterUrlPrefix = 'mod/gallery/images';
SGui.itemInTable = -1;
SGui.resultContainer = '#galleryImagesTable';
SGui.saveOrder = true;
SGui.sort = true;

// Action buttons
SGui.actionButtonRestore = '.action-restore';
SGui.actionButtonDelete = '.action-delete';

// Delete messages
SGui.actionDeleteMessage = "Sto eliminando l'immagine...";
SGui.actionDeleteQuestion = "Sei sicuro di voler eliminare l'immagine selezionata?";

// Restore messages
SGui.actionRestoreMessage = "Sto ripristinando l'immagine...";
SGui.actionRestoreQuestion = "Sei sicuro di voler ripristinare l'immagine selezionata?";

// Start script
SGui.init();
