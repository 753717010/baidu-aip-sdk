<?php
/*
* Copyright (c) 2017 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not
* use this file except in compliance with the License. You may obtain a copy of
* the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations under
* the License.
*/

namespace cje\BaiduAIP\request;

class AipBodyAnalysis extends Api
{
    /**
     * 人体关键点识别 body_analysis api url
     * @var string
     */
    private $bodyAnalysisUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_analysis';

    /**
     * 人体检测与属性识别 body_attr api url
     * @var string
     */
    private $bodyAttrUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_attr';

    /**
     * 人流量统计 body_num api url
     * @var string
     */
    private $bodyNumUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_num';

    /**
     * 手势识别 gesture api url
     * @var string
     */
    private $gestureUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/gesture';

    /**
     * 人像分割 body_seg api url
     * @var string
     */
    private $bodySegUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_seg';

    /**
     * 驾驶行为分析 driver_behavior api url
     * @var string
     */
    private $driverBehaviorUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/driver_behavior';

    /**
     * 人流量统计-动态版 body_tracking api url
     * @var string
     */
    private $bodyTrackingUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_tracking';


    /**
     * 人体关键点识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function bodyAnalysis($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->bodyAnalysisUrl, $data);
    }

    /**
     * 人体检测与属性识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type gender,<br>age,<br>lower_wear,<br>upper_wear,<br>headwear,<br>glasses,<br>upper_color,<br>lower_color,<br>cellphone,<br>upper_wear_fg,<br>upper_wear_texture,<br>lower_wear_texture,<br>orientation,<br>umbrella,<br>bag,<br>smoke,<br>vehicle,<br>carrying_item,<br>upper_cut,<br>lower_cut,<br>occlusion &#124; 1）可选值说明：<br>gender-性别，<br>age-年龄阶段，<br>lower_wear-下身服饰，<br>upper_wear-上身服饰，<br>headwear-是否戴帽子，<br>glasses-是否戴眼镜，<br>upper_color-上身服饰颜色，<br>lower_color-下身服饰颜色，<br>cellphone-是否使用手机，<br>upper_wear_fg-上身服饰细分类，<br>upper_wear_texture-上身服饰纹理，<br>orientation-身体朝向，<br>umbrella-是否撑伞；<br>bag-背包,<br>smoke-是否吸烟,<br>vehicle-交通工具,<br>carrying_item-是否有手提物,<br>upper_cut-上方截断,<br>lower_cut-下方截断,<br>occlusion-遮挡<br>2）type 参数值可以是可选值的组合，用逗号分隔；**如果无此参数默认输出全部20个属性**
     * @return array
     */
    public function bodyAttr($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->bodyAttrUrl, $data);
    }

    /**
     * 人流量统计接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   area 特定框选区域坐标，逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，默认尾点和首点相连做闭合，**此参数为空或无此参数默认识别整个图片的人数**
     *   show 是否输出渲染的图片，默认不返回，**选true时返回渲染后的图片(base64)**，其它无效值或为空则默认false
     * @return array
     */
    public function bodyNum($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->bodyNumUrl, $data);
    }

    /**
     * 手势识别接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function gesture($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->gestureUrl, $data);
    }

    /**
     * 人像分割接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type 可以通过设置type参数，自主设置返回哪些结果图，避免造成带宽的浪费<br>1）可选值说明：<br>labelmap - 二值图像，需二次处理方能查看分割效果<br>scoremap - 人像前景灰度图<br>foreground - 人像前景抠图，透明背景<br>2）type 参数值可以是可选值的组合，用逗号分隔；如果无此参数默认输出全部3类结果图
     * @return array
     */
    public function bodySeg($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->bodySegUrl, $data);
    }

    /**
     * 驾驶行为分析接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type smoke,cellphone,<br>not_buckling_up,<br>both_hands_leaving_wheel,<br>not_facing_front |识别的属性行为类别，英文逗号分隔，默认所有属性都识别；<br>smoke //吸烟，<br>cellphone //打手机 ，<br>not_buckling_up // 未系安全带，<br>both_hands_leaving_wheel // 双手离开方向盘，<br>not_facing_front // 视角未看前方
     * @return array
     */
    public function driverBehavior($image, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post($this->driverBehaviorUrl, $data);
    }

    /**
     * 人流量统计-动态版接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $dynamic - true：动态人流量统计，返回总人数、跟踪ID、区域进出人数；<br>false：静态人数统计，返回总人数
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   case_id 任务ID（通过case_id区分不同视频流，自拟，不同序列间不可重复即可）
     *   case_init 每个case的初始化信号，为true时对该case下的跟踪算法进行初始化，为false时重载该case的跟踪状态。当为false且读取不到相应case的信息时，直接重新初始化
     *   show 否返回结果图（含统计值和跟踪框渲染），默认不返回，选true时返回渲染后的图片(base64)，其它无效值或为空则默认false
     *   area 静态人数统计时，只统计区域内的人，缺省时为全图统计。<br>动态人流量统计时，进出区域的人流会被统计。<br>逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的xy坐标（默认尾点和首点相连），形成闭合多边形区域。<br>服务会做范围（顶点左边需在图像范围内）及个数校验（数组长度必须为偶数，且大于3个顶点）。只支持单个多边形区域，建议设置矩形框，即4个顶点。**坐标取值不能超过图像宽度和高度，比如1280的宽度，坐标值最小建议从1开始，最大到1279**。
     * @return array
     */
    public function bodyTracking($image, $dynamic, $options = array())
    {

        $data = array();

        $data['image'] = base64_encode($image);
        $data['dynamic'] = $dynamic;

        $data = array_merge($data, $options);

        return $this->post($this->bodyTrackingUrl, $data);
    }
}