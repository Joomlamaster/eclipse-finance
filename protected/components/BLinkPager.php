<?php 
class BLinkPager extends CLinkPager
{
	public function run()
	{
		$this->registerClientScript();
		$url=CHtml::asset(Yii::getPathOfAlias('webroot.css.extended.pager').'.css');
		Yii::app()->getClientScript()->registerCssFile($url);	
		
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;

		echo CHtml::tag('div',$this->htmlOptions,implode("\n",$buttons));
	}	
	
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
		return CHtml::link($label,$this->createPageUrl($page), array('class' => 'btn '.$class));
	}	
}
?>