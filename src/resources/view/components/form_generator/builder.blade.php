<div id="builder-content">
	
	<div class="row">
		<div class="col-md-4">
			<div class="card card-default card-cool">
				<div class="card-header separator separator-cool" style="margin-bottom: 0; padding: 6px 0;">
					<select id="available-components-select" class="full-width"></select>
				</div>
				<div class="card-block" style="padding: 0;">
					<div style="min-height:300px;max-height:300px;overflow-x: hidden;overflow-y: auto;">
						<div class="tab-content" id="available-components-tab-content"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-default card-cool">
				<div class="card-header separator separator-cool" style="margin-bottom: 0;">
					<div class="row">
						<div class="col-md-8">
							<div class="card-title">
								Form
							</div>
						</div>
						<div class="col-md-4">
							<button id="builder-save"
							        class="btn btn-void btn-xs pull-right"
							        style="margin-top: -6px;"
							        title="Salva form">
								<i class="fas fa-save fa-lg fa-fw"></i>
							</button>
							<button id="builder-add-row-button"
							        class="btn btn-void btn-xs pull-right"
							        style="margin-top: -6px;"
							        title="Nuova riga">
								<i class="fas fa-plus-circle fa-lg fa-fw"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="card-block scrollable">
					<div style="min-height:260px;max-height:260px;">
						<div id="builder-grid">
							<h5 class="mt-0">
								Seleziona un form per iniziare
							</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


@push('modal-container')
	
	<!-- MODAL CREAZIONE NUOVA RIGA -->
	<div class="modal fade slide-up" id="modal-add-row" data-keyboard="false" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content-wrapper">
				<div class="modal-content">
					<div class="modal-header clearfix text-left">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="pg-close fs-14"></i>
						</button>
						<h5>Nuova riga</h5>
					</div>
					<div class="modal-body">
						<div id="modal-add-row-content"></div>
						<a href="#" id="modal-add-row-add-column">
							<i class="fas fa-plus fa-fw"></i> Aggiungi nuova colonna
						</a>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" disabled id="modal-add-row-save">
							<i class="fas fa-save fa-fw"></i> Salva
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODAL AGGIUNTA COMPONENTE IN GRIGLIA -->
	<div class="modal fade slide-up" id="modal-add-component" data-keyboard="false" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content-wrapper">
				<div class="modal-content">
					<div class="modal-header clearfix text-left">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="pg-close fs-14"></i>
						</button>
						<h5>Aggiungi componente</h5>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-12">
								<label class="text-cool m-0">Componente</label>
								<p id="component-name"></p>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default form-group-default-select2 required">
									<label for="component-position">Posizione</label>
									<select id="component-position" class="full-width" tabindex="-1" autocomplete="off">
										<option></option>
									</select>
								</div>
							</div>
						</div>
						<div class="row" id="component-description-content" style="display: none;">
							<div class="col-md-12">
								<div class="form-group form-group-default required">
									<label for="component-description">Descrizione</label>
									<input class="form-control form-data" type="text" id="component-description"
									       autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row" id="component-options-content">
							<div class="col-md-12">
								<label class="text-cool">Opzioni</label>
								<div id="component-options-items"></div>
								<a href="#" id="component-options-add">Aggiungi nuova opzione</a>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" id="modal-add-component-save">
							<i class="fas fa-save fa-fw"></i> Salva
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


@endpush
