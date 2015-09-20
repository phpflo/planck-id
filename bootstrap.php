<?php

require_once 'vendor/autoload.php';

require_once 'src/Flo/FloComponent.php';
require_once 'src/Flo/ExtendedFloGraph.php';
require_once 'src/Flo/InvokableFloComponent.php';
require_once 'src/Flo/ExtendedFloPort.php';
require_once 'src/Flo/ExtendedFloArrayPort.php';
require_once 'src/Flo/ExtendedFloNetwork.php';

require_once 'src/Utilities/ArrayToString.php';
require_once 'src/Utilities/StringToArray.php';
require_once 'src/Utilities/ReadExternalFile.php';
require_once 'src/Utilities/FlattenAndUniqueArray.php';
require_once 'src/Utilities/functions.php';

require_once 'src/Content/WriteContent.php';
require_once 'src/Content/ReadContent.php';
require_once 'src/Content/Content.php';
require_once 'src/Content/StaticContent.php';

require_once 'src/Planck/OriginalAndPlanckMap.php';
require_once 'src/Planck/PlanckCollectionBuilder.php';
require_once 'src/Planck/Plancks.php';
require_once 'src/Planck/PlanckCollectionIterator.php';

require_once 'src/Originals/AddOriginals.php';
require_once 'src/Originals/ReadOriginalAndPlanckMap.php';
require_once 'src/Originals/WriteOriginalAndPlanckMap.php';
require_once 'src/Originals/OriginalsToPlancks.php';
require_once 'src/Originals/RemoveUselessOriginals.php';
require_once 'src/Originals/SortOriginalsByLength.php';

require_once 'src/Output/DisplayOutputForTesting.php';
require_once 'src/Output/EmptyOutputForTesting.php';
require_once 'src/Output/OutputOriginalForTesting.php';
require_once 'src/Output/OutputToFile.php';
require_once 'src/Output/TestingContentOutput.php';
require_once 'src/Output/OutputFinal.php';

require_once 'src/Regex/RegexInOut.php';
require_once 'src/Regex/RegexInStringOut.php';
require_once 'src/Regex/InlineStylesRegex.php';
require_once 'src/Regex/StyleBlocksRegex.php';
require_once 'src/Regex/JavaScriptFileSourceRegex.php';
require_once 'src/Regex/JavaScriptRegex.php';
require_once 'src/Regex/MarkupClassesRegex.php';
require_once 'src/Regex/MarkupIdentitiesRegex.php';
require_once 'src/Regex/RegexInArrayWithOriginalOut.php';
require_once 'src/Regex/StyleClassesRegex.php';
require_once 'src/Regex/StyleIdentitiesRegex.php';
require_once 'src/Regex/MarkupClassesFromMatchedRegex.php';

require_once 'src/Replace/AbstractIdentitiesOut.php';
require_once 'src/Replace/AbstractNonMarkupPlanckOut.php';
require_once 'src/Replace/FloReplace.php';
require_once 'src/Replace/FloReplaceFinal.php';
require_once 'src/Replace/FloStyle.php';
require_once 'src/Replace/Replace.php';
require_once 'src/Replace/ReplaceJavaScript.php';
require_once 'src/Replace/ReplaceJavaScriptContent.php';
require_once 'src/Replace/ReplaceMarkupClasses.php';
require_once 'src/Replace/ReplaceMarkupIdentities.php';
require_once 'src/Replace/ReplaceStyleSelectors.php';

require_once 'src/Core/ExtractOriginals.php';
require_once 'src/Core/ExtractAndReplace.php';
require_once 'src/Core/ContentAndMap.php';

require_once 'src/Emitter.php';
require_once 'src/FloMarkup.php';
require_once 'src/ReadRepeater.php';
require_once 'src/ReadRepeaterFinal.php';
require_once 'src/StyleRegexRepeater.php';
