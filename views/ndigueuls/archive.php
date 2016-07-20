<form id="archiveNdigueulForm" name="archiveNdigueulForm"
	ng-submit="confirmArchiveNdigueul()" class="form-horizontal">
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
					<small>Motif d'archivage</small>
				</h1>
				<!--  address style="margin-left: 2%"-->
				<p>
					<!-- form name="archiveEtbForm" ng-submit="confirmArchive()"-->

					<textarea required id="motifArchive" name="motifArchive" rows="7"
						cols="60"></textarea>
					<br />
				</p>
			</div>

		</div>
		<div class="modal-footer">
			<button class="btn btn-xs" type="reset" id="cancelArchiveNdigueul"
				ng-click="cancelArchive()">
				<i class="ace-icon fa fa-times red2"></i>Annuler
			</button>
			<button class="btn btn-xs btn-primary" id="doArchiveNdigueul"
				type="submit">
				<i class="ace-icon fa fa-check green"></i>Archiver
			</button>
		</div>
	</div>
</form>
<!--  /modal -->