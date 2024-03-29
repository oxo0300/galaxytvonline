<?php
/**
 * VersionX
 *
 * Copyright 2011 by Mark Hamstra <hello@markhamstra.com>
 *
 * VersionX is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * VersionX is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * VersionX; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * VersionX 2.0.0rc1 German language file contributed by luk
 *
 * @package versionx
 */

$_lang['versionx'] = 'VersionX';
$_lang['versionx.tabheader'] = 'Versionen';
$_lang['versionx.menu_desc'] = 'Sichert Ihren wertvollen Content.';

$_lang['versionx.common.empty'] = '&lt;leer&gt;';
$_lang['versionx.common.version-details'] = 'Version Details';
$_lang['versionx.common.detail.text'] = 'Unten finden Sie die Details für die [[+what]] Version, die Sie ausgewählt haben. Um diese Version mit einer anderen zu vergleichen, wählen Sie über die Combobox unten eine andere Version aus.';

$_lang['versionx.home'] = 'VersionX';
$_lang['versionx.home.text'] = 'VersionX ist ein nützliches Werkzeug für MODX Revolution, das Ihnen hilft den Überblick über Ihre Inhalte in Ressourcen, Templates, Chunks, Snippets und Plugins zu behalten. Jeder Speichervorgang wird aufgezeichnet und kann leicht verglichen und wiederhergestellt bzw. rückgängig gemacht werden. Bitte beachten Sie, dass die Schnittstelle für Chunks, Snippets und Plugins noch nicht enthalten sind, die Daten werden in der Datenbank gespeichert und stehen zur Verfügung, sobald die Funktionen implementiert sind. <br /> <br />
	VersionX steht kostenlos (und Open Source) zur Verfügung, jedoch wurde eine Menge Zeit in Entwicklung, Wartung und Support investiert. Bitte <a href="http://www.markhamstra.com/open-source/versionx/">denken Sie über eine Spende nach</a> und unterstütze die zukünftige Weiterentwicklung von VersionX';


$_lang['versionx.resources.detail'] = 'Ressourcendetails';
$_lang['versionx.resources.detail.text'] = 'Unten finden Sie Details zur ausgewählten Ressourcenversion. Um diese Version mit einer anderen zu vergleichen, wählen Sie über die Combobox unten eine andere Version aus.';
$_lang['versionx.resources.revert'] = 'Zurücksetzen auf Version #[[+id]]';
$_lang['versionx.resources.revert.options'] = 'Resource zurücksetzen';
$_lang['versionx.resources.revert.confirm'] = 'Sind Sie sicher?';
$_lang['versionx.resources.revert.confirm.text'] = 'Sind Sie sicher, dass Sie zur Version #[[+id]] zurückkehren wollen? Dies überschreibt ALLE Felder und Template Variablen, die momentan für die Ressource festgelegt sind und ersetzt die Werte mit denjenigen in der ausgewählten Ressourcenversion.';
$_lang['versionx.resources.reverted'] = 'Ressourcenversion erfolgreich wiederhergestellt!';

$_lang['versionx.resources.detail.tabs.resource-fields'] = 'Felder';
$_lang['versionx.resources.detail.tabs.resource-content'] = 'Content';
$_lang['versionx.resources.detail.tabs.resource-content.columnheader'] = 'Content für Version #[[+id]]';
$_lang['versionx.resources.detail.tabs.template-variables'] = 'Template Variablen';
$_lang['versionx.resources.detail.tabs.page-settings'] = 'Seiteneinstellungen';

$_lang['versionx.resources.detail.grid.columns.field-name'] = 'Feldname';
$_lang['versionx.resources.detail.grid.columns.field-value'] = 'Feldinhalt [Ver #[[+id]]]';

$_lang['versionx.templates.detail.tabs.fields'] = 'Felder';
$_lang['versionx.templates.detail.tabs.content'] = 'Content';
$_lang['versionx.templates.detail.tabs.properties'] = 'Eigenschaften';
$_lang['versionx.templates.detail.tabs.properties.off'] = 'Sorry, dieses Tab kann noch nicht angezeigt werden.';
$_lang['versionx.templates.detail'] = 'Template Details';
$_lang['versionx.templates.detail.text'] = 'Unten finden Sie Details zur ausgewählten Template-Version. Um diese Version mit einer anderen zu vergleichen, wählen Sie über die Combobox unten eine andere Version aus.';

$_lang['versionx.templatevars.detail.tabs.input-options'] = 'Eingabe-Optionen';
$_lang['versionx.templatevars.detail.tabs.output-options'] = 'Ausgabe-Optionen';
$_lang['versionx.templatevars.detail.tabs.properties'] = 'Eigenschaften';
$_lang['versionx.templatevars.detail.tabs.properties.off'] = 'Sorry, dieses Tab kann noch nicht angezeigt werden.';

$_lang['versionx.templatevars.detail'] = 'Template Variable Details';
$_lang['versionx.templatevars.detail.input-type'] = 'Eingabetyp';
$_lang['versionx.templatevars.detail.input-properties'] = 'Eingabe-Optionswerte';
$_lang['versionx.templatevars.detail.default-text'] = 'Standardwert';
$_lang['versionx.templatevars.detail.output-type'] = 'Ausgabetyp';
$_lang['versionx.templatevars.detail.output-properties'] = 'Ausgabe-Optionswerte';

$_lang['versionx.chunks.detail.tabs.fields'] = 'Felder';
$_lang['versionx.chunks.detail.tabs.content'] = 'Content';
$_lang['versionx.chunks.detail.tabs.properties'] = 'Eigenschaften';
$_lang['versionx.chunks.detail.tabs.properties.off'] = 'Sorry, dieses Tab kann noch nicht angezeigt werden.';
$_lang['versionx.chunks.detail'] = 'Template Details';
$_lang['versionx.chunks.detail.text'] = 'Unten finden Sie Details zur ausgewählten Chunk-Version. Um diese Version mit einer anderen zu vergleichen, wählen Sie über die Combobox unten eine andere Version aus.';


$_lang['versionx.menu.viewdetails'] = 'Version Details ansehen';
$_lang['versionx.back'] = 'Zurück zur Übersicht';
$_lang['versionx.backtoresource'] = 'Zurück zur Ressource';
$_lang['versionx.compare_to'] = 'Vergleichen mit';
$_lang['versionx.compare_this_version_to'] = 'Diese Version vergleichen mit';
$_lang['versionx.filter'] = '[[+what]] filtern';
$_lang['versionx.filter.reset'] = 'Filter zurücksetzen';
$_lang['versionx.filter.datefrom'] = 'Von';
$_lang['versionx.filter.dateuntil'] = 'Bis';

$_lang['versionx.version_id'] = 'Version ID';
$_lang['versionx.content_id'] = '[[+what]] ID';
$_lang['versionx.content_name'] = '[[+what]] Name';
$_lang['versionx.mode'] = 'Art';
$_lang['versionx.mode.new'] = 'Erstellen';
$_lang['versionx.mode.upd'] = 'Update';
$_lang['versionx.mode.snapshot'] = 'Snapshot';
$_lang['versionx.mode.revert'] = 'Zurückgesetzt';
$_lang['versionx.saved'] = 'Gespeichert am';
$_lang['versionx.title'] = 'Titel';
$_lang['versionx.marked'] = 'Markiert';

$_lang['versionx.error.noresults'] = 'Für Ihre Anfrage konnten keine Resultate gefunden werden.';
$_lang['versionx.tabtip.notyet'] = 'Sorry, leider können wir die History für [[+what]] noch nicht anzeigen. Veränderungen werden jedoch bereits jetzt in die Datenbank geschrieben, sobald diese Funktionen implementiert sind, werden sie hier angezeigt!';
