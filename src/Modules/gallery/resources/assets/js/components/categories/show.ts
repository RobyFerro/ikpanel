/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

import SimpleGui from '../../../../../../../resources/assets/js/modules/simple-gui';

const SGui = new SimpleGui();

// General settings
SGui.table = '#galleryCategoryTable';
SGui.searchFilter = '#search-filter';
SGui.statusFilter = '#status-filter';
SGui.filterUrlPrefix = 'mod/gallery/categories';
SGui.itemInTable = -1;
SGui.resultContainer = '#galleryCategoryTable';
SGui.saveOrder = true;
SGui.sort = true;

// Action buttons
SGui.actionButtonRestore = '.action-restore';
SGui.actionButtonDelete = '.action-delete';

// Delete messages
SGui.actionDeleteMessage = 'Sto eliminando la categoria...';
SGui.actionDeleteQuestion = 'Sei sicuro di voler eliminare la categoria selezionata?';

// Restore messages
SGui.actionRestoreMessage = 'Sto ripristinando la categoria...';
SGui.actionRestoreQuestion = 'Sei sicuro di voler ripristinare la categoria selezionata?';

// Start script
SGui.init();
