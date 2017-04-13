<?php

use Illuminate\Database\Seeder;

class SkosPropertySeeder extends Seeder
{
    use \Database\DisablesForeignKeys;

  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $this->disableForeignKeys();

        $updateStatement = "
INSERT INTO `reg_skos_property` (`id`, `parent_id`, `inverse_id`, `name`, `uri`, `object_type`, `display_order`, `picklist_order`, `label`, `definition`, `comment`, `examples`, `is_required`, `is_reciprocal`, `is_singleton`, `is_scheme`, `is_in_picklist`) VALUES
	(1,0,NULL,'altLabel','http://www.w3.org/2004/02/skos/core#altLabel','literal',1,110,'alternative label','An alternative lexical label for a resource.','Acronyms, abbreviations, spelling variants, and irregular plural/singular forms may be included among the alternative labels for a concept. Mis-spelled terms are normally included as hidden labels (see skos:hiddenLabel).','http://www.w3.org/2004/02/skos/core/examples/altLabel.rdf.xml',0,0,0,0,1),
	(2,26,NULL,'altSymbol','http://www.w3.org/2004/02/skos/core#altSymbol','literal',2,NULL,'alternative symbolic label','An alternative symbolic label for a resource.',NULL,'http://www.w3.org/2004/02/skos/core/examples/altSymbol.rdf.xml',0,0,0,0,0),
	(3,NULL,16,'broader','http://www.w3.org/2004/02/skos/core#broader','resource',3,400,'has broader','A concept that is more general in meaning.','Broader concepts are typically rendered as parents in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/broader.rdf.xml',0,0,0,0,1),
	(4,17,NULL,'changeNote','http://www.w3.org/2004/02/skos/core#changeNote','literal',4,320,'change note','A note about a modification to a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/changeNote.rdf.xml',0,0,0,0,1),
	(5,17,NULL,'definition','http://www.w3.org/2004/02/skos/core#definition','literal',NULL,205,'definition','A statement or formal explanation of the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/definition.rdf.xml',0,0,0,0,1),
	(6,17,NULL,'editorialNote','http://www.w3.org/2004/02/skos/core#editorialNote','literal',NULL,310,'editorial note','A note for an editor, translator or maintainer of the vocabulary.',NULL,'http://www.w3.org/2004/02/skos/core/examples/editorialNote.rdf.xml',0,0,0,0,1),
	(7,17,NULL,'example','http://www.w3.org/2004/02/skos/core#example','literal',NULL,210,'example','An example of the use of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/example.rdf.xml',0,0,0,0,1),
	(9,0,NULL,'hiddenLabel','http://www.w3.org/2004/02/skos/core#hiddenLabel','literal',NULL,120,'hidden label','A lexical label for a resource that should be hidden when generating visual displays of the resource, but should still be accessible to free text search operations.',NULL,'http://www.w3.org/2004/02/skos/core/examples/hiddenLabel.rdf.xml',0,0,0,0,1),
	(10,17,NULL,'historyNote','http://www.w3.org/2004/02/skos/core#historyNote','literal',NULL,330,'history note',NULL,'A note about the past state/use/meaning of a concept.','http://www.w3.org/2004/02/skos/core/examples/historyNote.rdf.xml',0,0,0,0,1),
	(11,NULL,0,'inScheme','http://www.w3.org/2004/02/skos/core#inScheme','resource',NULL,600,'in scheme','A concept scheme in which the concept is included.','A concept may be a member of more than one concept scheme.','http://www.w3.org/2004/02/skos/core/examples/inScheme.rdf.xml',1,0,0,0,0),
	(12,NULL,24,'isSubjectOf','http://www.w3.org/2004/02/skos/core#isSubjectOf','resource',NULL,NULL,'is subject of','A resource for which the concept is a subject.',NULL,'http://www.w3.org/2004/02/skos/core/examples/isSubjectOf.rdf.xml',0,0,0,0,0),
	(13,12,20,'isPrimarySubjectOf','http://www.w3.org/2004/02/skos/core#isPrimarySubjectOf','resource',NULL,NULL,'is primary subject of','A resource for which the concept is the primary subject.',NULL,NULL,0,0,0,0,0),
	(16,NULL,3,'narrower','http://www.w3.org/2004/02/skos/core#narrower','resource',NULL,410,'has narrower','A concept that is more specific in meaning.','Narrower concepts are typically rendered as children in a concept hierarchy (tree).','http://www.w3.org/2004/02/skos/core/examples/narrower.rdf.xml',0,0,0,0,1),
	(17,NULL,NULL,'note','http://www.w3.org/2004/02/skos/core#note','literal',NULL,200,'note','A general note, for any purpose.','This property may be used directly, or as a super-property for more specific note types.','http://www.w3.org/2004/02/skos/core/examples/note.rdf.xml',0,0,0,0,1),
	(18,26,NULL,'prefSymbol','http://www.w3.org/2004/02/skos/core#prefSymbol','literal',NULL,NULL,'preferred symbolic label','The preferred symbolic label for a resource.','No two concepts in the same concept scheme may have the same value for skos:prefSymbol.','http://www.w3.org/2004/02/skos/core/examples/prefSymbol.rdf.xml',0,0,0,0,0),
	(19,0,NULL,'prefLabel','http://www.w3.org/2004/02/skos/core#prefLabel','literal',NULL,100,'preferred label','The preferred lexical label for a resource, in a given language.','No two concepts in the same concept scheme may have the same value for skos:prefLabel in a given language.','http://www.w3.org/2004/02/skos/core/examples/prefLabel.rdf.xml',1,0,0,0,1),
	(20,24,NULL,'primarySubject','http://www.w3.org/2004/02/skos/core#primarySubject','literal',NULL,NULL,'has primary subject','A concept that is the primary subject of the resource.','A resource may have only one primary subject per concept scheme.','http://www.w3.org/2004/02/skos/core/examples/primarySubject.rdf.xml',0,0,0,0,0),
	(21,NULL,21,'related','http://www.w3.org/2004/02/skos/core#related','resource',NULL,420,'related to','A concept with which there is an associative semantic relationship.',NULL,'http://www.w3.org/2004/02/skos/core/examples/related.rdf.xml',0,1,0,0,1),
	(22,17,NULL,'scopeNote','http://www.w3.org/2004/02/skos/core#scopeNote','literal',NULL,300,'scope note','A note that helps to clarify the meaning of a concept.',NULL,'http://www.w3.org/2004/02/skos/core/examples/scopeNote.rdf.xml',0,0,0,0,1),
	(24,NULL,12,'subject','http://www.w3.org/2004/02/skos/core#subject','resource',NULL,NULL,'has subject','A concept that is a subject of the resource.','The following rule may be applied for this property: [(?d skos:subject ?x)(?x skos:broader ?y) implies (?d skos:subject ?y)]','http://www.w3.org/2004/02/skos/core/examples/subject.rdf.xml',0,0,0,0,0),
	(25,NULL,NULL,'subjectIndicator','http://www.w3.org/2004/02/skos/core#subjectIndicator','resource',NULL,NULL,'subject indicator','A subject indicator for a concept. [The notion of ''subject indicator'' is defined here with reference to the latest definition endorsed by the OASIS Published Subjects Technical Committee.]','This property allows subject indicators to be used for concept identification in place of or in addition to directly assigned URIs.','http://www.w3.org/2004/02/skos/core/examples/subjectIndicator.rdf.xml',0,0,0,0,0),
	(26,NULL,NULL,'symbol','http://www.w3.org/2004/02/skos/core#symbol','literal',NULL,NULL,'symbolic label','An image that is a symbolic label for the resource.','This property is roughly analagous to rdfs:label, but for labelling resources with images that have retrievable representations, rather than RDF literals.','http://www.w3.org/2004/02/skos/core/examples/symbol.rdf.xml',0,0,0,0,0),
	(27,NULL,NULL,'label','http://www.w3.org/2000/01/rdf-schema#label','literal',NULL,90,'label','A human-readable name for the subject.',NULL,NULL,0,0,0,0,0),
	(28,NULL,29,'hasTopConcept','http://www.w3.org/2004/02/skos/core#hasTopConcept','literal',NULL,NULL,'has top concept','Relates, by convention, a concept scheme to a concept which is topmost in the broader/narrower concept hierarchies for that scheme, providing an entry point to these hierarchies.',NULL,NULL,0,0,0,0,0),
	(29,11,28,'topConceptOf','http://www.w3.org/2004/02/skos/core#topConceptOf','resource',NULL,610,'top concept of','Relates a concept to the concept scheme that it is a top level concept of.',NULL,NULL,0,0,0,0,0),
	(30,NULL,NULL,'notation','http://www.w3.org/2004/02/skos/core#notation','literal',NULL,140,'notation',NULL,NULL,NULL,0,0,0,0,1),
	(31,NULL,NULL,'ConceptScheme','http://www.w3.org/2004/02/skos/core#ConceptScheme','resource',NULL,NULL,'Concept Scheme','A set of concepts, optionally including statements about semantic relationships between those concepts.','A concept scheme may be defined to include concepts from different sources.',NULL,0,0,0,0,0),
	(32,37,33,'broadMatch','http://www.w3.org/2004/02/skos/core#broadMatch','resource',NULL,500,'has broader match','skos:broadMatch is used to state a hierarchical mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,0,0,0,1),
	(33,37,32,'narrowMatch','http://www.w3.org/2004/02/skos/core#narrowMatch','resource',NULL,510,'has narrower match','skos:narrowMatch is used to state a hierarchical mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,0,0,0,1),
	(34,37,34,'relatedMatch','http://www.w3.org/2004/02/skos/core#relatedMatch','resource',NULL,520,'has related match','skos:relatedMatch is used to state an associative mapping link between two conceptual resources in different concept schemes.',NULL,NULL,0,1,0,0,1),
	(35,37,35,'exactMatch','http://www.w3.org/2004/02/skos/core#exactMatch','resource',NULL,540,'has exact match','skos:exactMatch is used to link two concepts, indicating a high degree of confidence that the concepts can be used interchangeably across a wide range of information retrieval applications. skos:exactMatch is a transitive property, and is a sub-property of skos:closeMatch.','skos:exactMatch is disjoint with each of the properties skos:broadMatch and skos:relatedMatch.',NULL,0,1,0,0,1),
	(36,37,36,'closeMatch','http://www.w3.org/2004/02/skos/core#closeMatch','resource',NULL,530,'has close match','skos:closeMatch is used to link two concepts that are sufficiently similar that they can be used interchangeably in some information retrieval applications. In order to avoid the possibility of \"compound errors\" when combining mappings across more than two concept schemes, skos:closeMatch is not declared to be a transitive property.',NULL,NULL,0,1,0,0,1),
	(37,NULL,NULL,'mappingRelation','http://www.w3.org/2004/02/skos/core#mappingRelation','resource',NULL,490,'is in mapping relation with','Relates two concepts coming, by convention, from different schemes, and that have comparable meanings','These concept mapping relations mirror semantic relations, and the data model defined below is similar (with the exception of skos:exactMatch) to the data model defined for semantic relations. A distinct vocabulary is provided for concept mapping relations, to provide a convenient way to differentiate links within a concept scheme from links between concept schemes. However, this pattern of usage is not a formal requirement of the SKOS data model, and relies on informal definitions of best practice.',NULL,0,0,0,0,1),
	(40,NULL,NULL,'statusId','reg:statusId','resource',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1),
	(41,NULL,NULL,'uri','reg:uri','resource',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1),
	(42,NULL,NULL,'ToolkitDefinition','rdakit:toolkitDefinition','literal',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1),
	(43,NULL,NULL,'ToolkitLabel','rdakit:toolkitLabel','literal',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,1);
";
        DB::update(DB::raw($updateStatement));

        $this->enableForeignKeys();
    }
}
