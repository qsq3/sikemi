<?php
/**************************ע��*****************************
1������ֱ�forum_thread
2�����ò�ͬ��Ȩ�����ڲ��sikemiĿ¼���ϴ���ӦȨ��������ͼƬ
************************************************************/


//Ӧ�ó������ݿ����Ӳ���
$dbhost = 'localhost';			// ���ݿ������
$dbuser = 'root';				// ���ݿ��û���
$dbpw = '198126';					// ���ݿ�����
$dbname = 'pt';				// ���ݿ���
$pconnect = 0;					// ���ݿ�־����� 0=�ر�, 1=��
$tablepre = 'pre_';   			// ����ǰ׺, ͬһ���ݿⰲװ�����̳���޸Ĵ˴�
$dbcharset = 'gbk';			// MySQL �ַ���, ��ѡ 'gbk', 'big5', 'utf8', 'latin1', ����Ϊ������̳�ַ����趨

//�ϴ�����Ȩ��
$upload_weight['top']=2;		//�ö��ϴ�Ȩ��
$upload_weight['digest']=1.5;           //�����ϴ�Ȩ��
$upload_weight['highlight']=1.2;        //�����ϴ�Ȩ��
$upload_weight['normal']=1;		//�����ϴ�Ȩ��

$down_weight['top']=0;          //�ö�����Ȩ��
$down_weight['digest']=0.5;     //��������Ȩ��
$down_weight['highlight']=0.8;  //��������Ȩ��
$down_weight['normal']=1;       //��������Ȩ��

$upload_credit=4;				//�ϴ����ֱ��
$down_credit=5;					//���ػ��ֱ��
$tracker_url="http://localhost/xbt/announce.php?pid=";//tracker��ַ
$ucenter_url="http://localhost/uc_server/";				//UCenter��ַ
$help_url="http://bbs.timefilm.org/forum.php?mod=viewthread&tid=2605";								//���̵ֽ̳�ַ���ڷ���ҳ����ʾ���������޸�
