<?php
namespace Waymen\Alipay;

use Illuminate\Support\ServiceProvider;

class AlipayServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('alipay.php'),
			__DIR__ . '/../../config/key/private_key.pem' => config_path('key/private_key.pem'),
			__DIR__ . '/../../config/key/public_key.pem' => config_path('key/public_key.pem'),
			__DIR__ . '/../../config/key/cacert.pem' => config_path('key/cacert.pem'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'alipay');
		// $this->mergeConfigFrom(__DIR__ . '/../../config/mobile.php', 'latrell-alipay-mobile');
		// $this->mergeConfigFrom(__DIR__ . '/../../config/web.php', 'latrell-alipay-web');
		// $this->mergeConfigFrom(__DIR__ . '/../../config/refund.php', 'latrell-alipay-refund');

		// $this->app->bind('alipay.mobile', function ($app)
		// {
		// 	$alipay = new Mobile\SdkPayment();

		// 	$alipay->setPartner($app->config->get('latrell-alipay.partner_id'))
		// 		->setSellerId($app->config->get('latrell-alipay.seller_id'))
		// 		->setSignType($app->config->get('latrell-alipay-mobile.sign_type'))
		// 		->setPrivateKeyPath($app->config->get('latrell-alipay-mobile.private_key_path'))
		// 		->setPublicKeyPath($app->config->get('latrell-alipay-mobile.public_key_path'))
		// 		->setNotifyUrl($app->config->get('latrell-alipay-mobile.notify_url'));

		// 	return $alipay;
		// });

		// $this->app->bind('alipay.web', function ($app)
		// {
		// 	$alipay = new Web\SdkPayment();

		// 	$alipay->setPartner($app->config->get('latrell-alipay.partner_id'))
		// 		->setSellerId($app->config->get('latrell-alipay.seller_id'))
		// 		->setKey($app->config->get('latrell-alipay-web.key'))
		// 		->setSignType($app->config->get('latrell-alipay-web.sign_type'))
		// 		->setNotifyUrl($app->config->get('latrell-alipay-web.notify_url'))
		// 		->setReturnUrl($app->config->get('latrell-alipay-web.return_url'))
		// 		->setExterInvokeIp($app->request->getClientIp());

		// 	return $alipay;
		// });

		// $this->app->bind('alipay.refund', function ($app)
		// {
		// 	$alipay = new Refund\SdkPayment();

		// 	$alipay->setPartner($app->config->get('latrell-alipay.partner_id'))
		// 		->setSellerId($app->config->get('latrell-alipay.seller_id'))
		// 		->setSignType($app->config->get('latrell-alipay-refund.sign_type'))
		// 		->setPrivateKeyPath($app->config->get('latrell-alipay-refund.private_key_path'))
		// 		->setPublicKeyPath($app->config->get('latrell-alipay-refund.public_key_path'))				
		// 		->setNotifyUrl($app->config->get('latrell-alipay-refund.notify_url'))
		// 		->setCacert($app->config->get('latrell-alipay-refund.cacert'));
		// 	return $alipay;
		// });	

		$this->app->bind('alipay', function ($app)
		{
			$alipay = new AlipayPaymentSdk();

			$alipay->setPartner($app->config->get('alipay.partner_id'))
				->setSellerId($app->config->get('alipay.seller_id'))
				->setSellerEmail($app->config->get('alipay.seller_email'))
				->setSignType($app->config->get('alipay.sign_type'))
				->setKey($app->config->get('alipay.key'))
				->setPrivateKeyPath($app->config->get('alipay.private_key_path'))
				->setPublicKeyPath($app->config->get('alipay.public_key_path'))
				->setCacert($app->config->get('alipay.cacert'))
				->setNotifyUrl($app->config->get('alipay.notify_url'))
				->setReturnUrl($app->config->get('alipay.return_url'));

			return $alipay;
		});		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			// 'alipay.mobile',
			// 'alipay.web',
			// 'alipay.refund',
			'alipay'
		];
	}
}
