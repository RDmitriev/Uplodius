<?
	/*
		Buttonator
		Simple social sharing buttons
		https://github.com/RDmitriev/Buttonator
	*/
	
	class Buttonator
	{
		public function Run($param)
		{
			return $this->Template($param->title);
		}
		
		private function Template($code)
		{
			return '<div class="Buttonator">' . $code . '</div>';
		}
		
		private function GooglePlus()
		{
			return;
		}
		
		private function Facebook()
		{
			return;
		}
		
		private function Twitter()
		{
			return;
		}
		
		private function Pinterest()
		{
			return;
		}
	}
?>