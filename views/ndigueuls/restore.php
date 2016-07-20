<form id="restoreNdigueulForm" name="restoreNdigueulForm"
	ng-submit="confirmRestoreNdigueul()" class="form-horizontal">
	<div>
		<div class="modal-body">

			<div class="row">
				<div>
                                    <address>&nbsp;&nbsp;Ndigueul {{ ndigueul.nom }} 
						</span> 
					</address>
				</div>
			</div>
			<!-- div d'insertion du motif d'archivage -->
			<div>
				<h1 style="margin-top: 0px;">
					<small>Motif de restauration</small>
				</h1>
				<p>
					<textarea required id="motifRestore" name="motifRestore" rows="7"
						cols="60"></textarea>
					<br />
				</p>
			</div>

		</div>
		<div class="modal-footer">
			<button class="btn btn-xs" type="reset" id="cancelRestoreNdigueul"
				ng-click="cancelRestore()">
				<i class="ace-icon fa fa-times red2"></i>Annuler
			</button>
			<button class="btn btn-xs btn-primary" id="doRestoreNdigueul"
				type="submit">
				<i class="ace-icon fa fa-check green"></i>Restaurer
			</button>
		</div>
	</div>
</form>
<!--  /modal -->