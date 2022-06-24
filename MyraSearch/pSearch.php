<?php

$sql = "SELECT a.sectionNumber, a.sectionTitleMalay, a.sectionTitleEnglish, b.subSectionTitleMalay, b.subSectionTitleEnglish, c.termTitleMalay, c.termTitleEnglish 
from myraterm c 
JOIN myrasubsection b ON c.subSectionId = b.subSectionId 
JOIN myrasection a ON a.sectionId = b.sectionId where c.termTitleMalay 
REGEXP 'e|g' OR c.termTitleEnglish REGEXP 's|f';"


?>