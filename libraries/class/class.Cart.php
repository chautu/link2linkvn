<?php
	class Cart
	{
		private $d;

		function __construct($d)
		{
			$this->d = $d;
		}

		public function get_product_info($pid=0)
		{
			$row = null;
			if($pid)
			{
				$row = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1",array($pid));
			}
			return $row;
		}
		public function get_detail_info($pid=0, $detail=0)
		{
			$row = null;
			if($pid)
			{
				$row = $this->d->rawQueryOne("select * from #_gallery where id_photo = ? and id = ? limit 0,1",array($pid,$detail));
			}
			return $row;
		}
		
		public function get_product_mau($mau=0)
		{
			global $lang;
			$str = '';
			if($mau)
			{
				$row = $this->d->rawQueryOne("select ten$lang as ten from #_product_mau where id = ? limit 0,1",array($mau));
				$str = $row['ten'];
			}
			return $str;
		}
		
		public function get_product_size($size=0)
		{
			global $lang;
			$str = '';
			if($size)
			{
				$row = $this->d->rawQueryOne("select ten$lang as ten from #_product_size where id = ? limit 0,1",array($size));
				$str = $row['ten'];
			}
			return $str;
		}
		
		public function remove_product($cart__=[], $code='')
		{
			$flag = 0;
			if(count($cart__) && $code != '')
			{
				foreach($cart__ as $key => $item) {
					if($code == $item->code)
					{
						unset($cart__[$key]);
						setcookie("cart__", json_encode($cart__), time() + 3600*24*30, "/");
						$flag = 1;
					}
				}
			}
			return $flag;
		}
		
		public function get_order_total($cart__=[])
		{
			$sum = 0;
			foreach($cart__ as $item) {
				$pid = $item->productid;
				$q = $item->qty;
				$detail = $item->detail;

				if($detail) {
					$proinfo = $this->get_detail_info($pid, $detail);
				} else {
					$proinfo = $this->get_product_info($pid);
				}

				if($proinfo['giamoi']) $price = $proinfo['giamoi'];
				else $price = $proinfo['gia'];
				$sum += ($price * $q);
			}
			return $sum;
		}
		
		public function addtocart($cart__=[], $q=1, $pid=0, $detail=0, $r_detail = [])
		{
			if($pid<1 or $q<1) return;

			$str = $pid;
			foreach($r_detail as $rdt) {
				$str .= '_'.$rdt;
			}
			
			$code = md5($str);

			if(count($cart__)) {
				if(!$this->product_exists($cart__,$code,$q))
				{
					$newItem = new \stdClass();
					$newItem->productid = $pid;
					$newItem->qty = $q;
					$newItem->detail = $detail;
					$newItem->r_detail = $r_detail;
					$newItem->code = $code;
					$cart__[] = $newItem;
					setcookie("cart__", json_encode($cart__), time() + 3600*24*30, '/');
					return 01;
				} else {
					return 00;
				}
			} else {
				$newItem = new \stdClass();
				$newItem->productid = $pid;
				$newItem->qty = $q;
				$newItem->detail = $detail;
				$newItem->r_detail = $r_detail;
				$newItem->code = $code;
				$cart__[] = $newItem;
				setcookie("cart__", json_encode($cart__), time() + 3600*24*30, '/');
				return 02;
			}
		}
		
		private function product_exists($cart__=[], $code='', $q=1)
		{
			$flag = 0;
			
			if(count($cart__) && $code != '')
			{
				$q = ($q>1)?$q:1;
				foreach($cart__ as $item) {
					if($code == $item->code) {
						if($item->detail) {
							$row = $this->d->rawQueryOne("select quantity, sold from #_gallery where id_photo = ? and id = ?", array($item->productid, $item->detail));
						} else {
							$row = $this->d->rawQueryOne("select quantity, sold from #_product where id = ?", array($item->productid));
						}
						if($item->qty + $q <= $row['quantity'] - $row['sold']) {
							$item->qty += $q;
							setcookie("cart__", json_encode($cart__), time() + 3600*24*30, "/");
						}
						$flag = 1;
					}
				}
			}
			return $flag;
		}

		public function updateCart($cart__=[], $code='', $q=1)
		{	
			if(count($cart__) && $code != '')
			{
				$q = ($q>1)?$q:1;
				foreach($cart__ as $item) {
					if($code == $item->code) {
						if($item->detail) {
							$row = $this->d->rawQueryOne("select giamoi, gia, quantity, sold from #_gallery where id_photo = ? and id = ?", array($item->productid, $item->detail));
						} else {
							$row = $this->d->rawQueryOne("select giamoi, gia quantity, sold from #_product where id = ?", array($item->productid));
						}
						if($q <= $row['quantity'] - $row['sold']) {
							$item->qty = $q;
							if($row['giamoi']) {
								$result = $q*$row['giamoi'];
							}else {
								$result = $q*$row['gia'];
							}
							setcookie("cart__", json_encode($cart__), time() + 3600*24*30, "/");
							return $result;
						}
						return false;
					}
				}
			}
		}
		// private function để tạo hàm chỉ trong class dùng
	}
?>