<?php 
/**
 * 版本更新相关类
 * @author AnneYan <ytt@yiban.cn>
 * @since 2014-06-09
 */
namespace App\Http\Controllers\Api;
use App\Services\SiteService;

/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/version",
 *   description="用户",
 *   @SWG\Produces("application/json")
 * )
 */
class VersionController extends BaseController
{
	

	/**
	 *
	 *
	 * @SWG\Api(
	 *   path="/version/checkupdate",
	 *   @SWG\Operations(
	 *     @SWG\Operation(
	 *       method="GET",
	 *       summary="检查版本更新类",
	 *       notes="Returns special list",
	 *       @SWG\Parameters(
	 *         @SWG\Parameter(
	 *           name="access_token",
	 *           description="登录返回token",
	 *           paramType="query",
	 *           required=true,
	 *           type="string"
	 *         ),
	 *       )
	 *     )
	 *   )
	 * )
	 *
	 * @return Response
	 */
	public function getCheckupdate(){
		
		$data = \Input::all();
		$rules = array (
				'access_token' => 'required',
		);
		parent::validator ( $data, $rules );
		//验证access_token 并获取用户信息
		$accountInfo = parent::validateAcessToken($data['access_token']);
		$userId = intval($accountInfo['user']['id']);
		//检查版本更新
		$current_version = isset($accountInfo['v']) ? $accountInfo['v'] : '';
		//$last_version = \Config::get('ybconfig.latest_cli_ver');
		$ct = isset($accountInfo['ct']) ? $accountInfo['ct'] : '';
		$update_version = SiteService::getInstance()->checkUpdate($current_version, $ct);
		$exit_update =  !empty($update_version) ? 1 : 0;
		$out = array('exit_update'=>$exit_update,'version'=>$update_version);
		return response()->forApi($out);
	}
	
}