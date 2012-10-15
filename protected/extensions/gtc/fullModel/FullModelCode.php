<?php
Yii::import('system.gii.generators.model.ModelCode');

class FullModelCode extends ModelCode
{
	public function prepare()
	{
		parent::prepare();

		// Make sure that the CAdvancedArBehavior is in the application components
		// Folder. if it is not, copy it over there

		$path = Yii::getPathOfAlias('application.components');
		if($path===false)
			mkdir($path);

 		if(!is_dir($path))
			die("Fatal Error: Your application components/ is not an directory!");	

		$names = scandir($path);

		if(!in_array('CAdvancedArBehavior.php', $names)) 
		{
			$gtcpath = Yii::getPathOfAlias('ext.gtc.vendors');
			if(!copy($gtcpath.'/CAdvancedArBehavior.php',
						$path.'/CAdvancedArBehavior.php'))
				die('CAdvancedArBehavior.php could not be copied over to your components directory');
		}

	}
}
?>
