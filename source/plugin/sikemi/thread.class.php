<?php

/*
	[Discuz!] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: homegrids.class.php 20541 2009-10-09 00:34:37Z monkey $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class threadplugin_sikemi {

	var $name = '������Դ';			//������������
	var $iconfile = 'source/plugin/sikemi/images/sikemi.gif';		//images/icons/ Ŀ¼����������������ͼƬ�ļ���
	var $buttontext = '������Դ';		//����ʱ��ť����

	function newthread($fid, $tid) {
		global $_G;
		$query=DB::query("select pid from ".DB::table('xbtit_users')." where uid={$_G['uid']} limit 1");
		$results=DB::fetch($query);
		if(empty($results)){
			$pid=md5(uniqid(rand(),true));	
			DB::query("insert into ".DB::table('xbtit_users')." (uid,pid) values ({$_G['uid']},'{$pid}')");
		}else{
			$pid=$results['pid'];
		}
		include('./xbt/config.inc.php');
		return <<<EOB
		<div style="border:dashed 4px #ccc;padding:10px 10px 10px 10px;margin-bottom:10px">
		<p>����tracker��ַΪ��<span style="color:#F00;">{$tracker_url}{$pid}</span>
		<span class="xw0 xs1 xg1">
		<a title="����tracker��ַ" href="javascript:setCopy('{$tracker_url}{$pid}', '����tracker��ַ�ɹ�');">[��������]</a></span>
		</p><p style="margin-top:10px;">
		�������֣�<a href="{$help_url}" target="_blank" style="color:#00F;">�����н̳�</a>&nbsp;�����ļ�:&nbsp;<input type='file' name='torrent' size='30' /></p>
		</div>
EOB;
	}

	function newthread_submit($fid, $tid) {
		if($_FILES['torrent']['size'] == 0){
			showmessage('δѡ�������ļ�');
		}elseif(substr($_FILES['torrent']['name'],-7)!='torrent'){
			showmessage('ѡ���ļ����Ϸ�');
		}
	}

	function newthread_submit_end($fid,$tid) {
		include('./source/plugin/sikemi/upload.inc.php');
	}

	function editpost($fid, $tid) {
		global $_G;
		$query=DB::query("select pid from ".DB::table('xbtit_users')." where uid={$_G['uid']} limit 1");
		$results=DB::fetch($query);
		if(empty($results)){
			$pid=md5(uniqid(rand(),true));	
			DB::query("insert into ".DB::table('xbtit_users')." (uid,pid) values ({$_G['uid']},'{$pid}')");
		}else{
			$pid=$results['pid'];
		}
		include('./xbt/config.inc.php');
		return <<<EOB
		<div style="border:dashed 4px #ccc;padding:10px 10px 10px 10px;margin-bottom:10px">
		<p>����tracker��ַΪ��<span style="color:#F00;">{$tracker_url}{$pid}</span>
		<span class="xw0 xs1 xg1">
		<a title="����tracker��ַ" href="javascript:setCopy('{$tracker_url}{$pid}', '����tracker��ַ�ɹ�');">[��������]</a></span>
		</p><p style="margin-top:10px;">
		�������֣�<a href="{$help_url}" target="_blank" style="color:#00F;">�����н̳�</a>&nbsp;�����ļ�:&nbsp;<input type='file' name='torrent' size='30' />(����Ϊ���޸����ӣ�)</p>
		<input type='hidden' name='edittorrent' value=1 />
		</div>
EOB;
	}

	function editpost_submit($fid, $tid) {

	}

	function editpost_submit_end($fid, $tid) {
		if($_FILES['torrent']['size'] != 0){
			include('./source/plugin/sikemi/upload.inc.php');
		}
	}

	function newreply_submit_end($fid, $tid) {

	}
	
	function viewthread($tid) {
		global $_G;
		$query=DB::query("select * from ".DB::table('xbtit_files')." where tid={$tid} limit 1");
		$results=DB::fetch($query);
		$filename=cutstr($results['filename'],40,"...");
		$lastactive=dgmdate($results['lastactive'],"u");
		$size=sizecount($results['size']);
		
		include('./xbt/config.inc.php');
		$query=DB::query("select displayorder,highlight,digest from ".DB::table('forum_thread')." where tid={$tid} limit 1");
		$rs=DB::fetch($query);
		if($rs['displayorder']>0){
			$up_image="up".$upload_weight['top'].".gif";
			$down_image="down".$down_weight['top'].".gif";
		}elseif($rs['digest']>0){
			$up_image="up".$upload_weight['digest'].".gif";
			$down_image="down".$down_weight['digest'].".gif";
		}elseif($rs['highlight']>0){
			$up_image="up".$upload_weight['highlight'].".gif";
			$down_image="down".$down_weight['highlight'].".gif";
		}else{
			$up_image="up".$upload_weight['normal'].".gif";
			$down_image="down".$down_weight['normal'].".gif";
		}
		if($_G['uid']>0){
            if($results['seeds']=='0') {
                return <<<EOB
                <div style="border:dashed 4px #ccc;padding-bottom:10px;margin-bottom:20px;">
                <span style="font-family: ΢���ź�;margin-top:10px;padding-left:10px;">
                    ����: <span style="color: red;">{$results['seeds']}</span>
                    ������: <span style="color: red;">{$results['leechers']}</span>
                    ���: <span style="color: red;">{$results['finished']}</span>
                    ��С: <span style="color: red;">{$size}</span>
                    ����ʱ��: <span style="color: red;">{$lastactive}</span>
                    <img title="����Ȩֵ" src="source/plugin/sikemi/images/{$down_image}" alt="normal" align="absmiddle"></span>
                    <img title="�ϴ�Ȩֵ" src="source/plugin/sikemi/images/{$up_image}" alt="normal" align="absmiddle">
                    
                </span><br/>
                <span style="padding-left:10px;">
                    <a href="http://www.utorrent.com/intl/zh_cn/" target="_blank"><img title="��ʹ��utorrent�������ļ�" src="source/plugin/sikemi/images/torrent.gif"align="absmiddle"></a>
                    <a onclick="if(!confirm('����Դ������Ϊ0�����ؿ���û���ٶȣ��Ƿ�������أ�����Ҳ������ϵ�ϴ��ߺͻ������صĻ�ԱŶ����')){return false;}" style="font-weight: bold;color:#09C" title="{$results['filename']}" href="plugin.php?id=sikemi:download&tid={$tid}">{$filename}</a>&nbsp;(<a href="plugin.php?id=sikemi:torr_info&tid={$tid}" style="color:#09C" onclick="showWindow('torrentinfo', this.href);return false;">�鿴��������</a>)&nbsp;
                        <a href="plugin.php?id=sikemi:downloaded_users&tid={$tid}" class="xw0 xs1 xg1" onclick="showWindow('torrentinfo', this.href);return false;" title="���û�����ӣ�������ϵ����Ŷ��">[��Щ�����ع�]</a>
                </span>
                </div>
EOB;
            } else {
                return <<<EOB
                    <div style="border:dashed 4px #ccc;padding-bottom:10px;margin-bottom:20px;">
                    <span style="font-family: ΢���ź�;margin-top:10px;padding-left:10px;">
                        ����: <span style="color: red;">{$results['seeds']}</span>
                        ������: <span style="color: red;">{$results['leechers']}</span>
                        ���: <span style="color: red;">{$results['finished']}</span>
                        ��С: <span style="color: red;">{$size}</span>
                        ����ʱ��: <span style="color: red;">{$lastactive}</span>
                        <img title="����Ȩֵ" src="source/plugin/sikemi/images/{$down_image}" alt="normal" align="absmiddle"></span>
                        <img title="�ϴ�Ȩֵ" src="source/plugin/sikemi/images/{$up_image}" alt="normal" align="absmiddle">
                        
                    </span><br/>
                    <span style="padding-left:10px;">
                        <a href="http://www.utorrent.com/intl/zh_cn/" target="_blank"><img title="��ʹ��utorrent�������ļ�" src="source/plugin/sikemi/images/torrent.gif"align="absmiddle"></a>
                        <a style="font-weight: bold;color:#09C" title="{$results['filename']}" href="plugin.php?id=sikemi:download&tid={$tid}">{$filename}</a>&nbsp; 
(<a href="plugin.php?id=sikemi:torr_info&tid={$tid}" style="color:#09C" onclick="showWindow('torrentinfo', this.href);return false;">�鿴��������</a>)&nbsp;
                        <a href="plugin.php?id=sikemi:downloaded_users&tid={$tid}" class="xw0 xs1 xg1" onclick="showWindow('torrentinfo', this.href);return false;" title="���û�����ӣ�������ϵ����Ŷ��">[��Щ�����ع�]</a>
                    </span>
                    </div>
EOB;
            }
		}else{
			return <<<EOB
			<div style="border:dashed 4px #ccc;padding-bottom:10px;margin-bottom:20px;">
			<span style="font-family: ΢���ź�;margin-top:10px;padding-left:10px;">
				����: <span style="color: red;">{$results['seeds']}</span>
				������: <span style="color: red;">{$results['leechers']}</span>
				���: <span style="color: red;">{$results['finished']}</span>
				��С: <span style="color: red;">{$size}</span>
				����ʱ��: <span style="color: red;">{$lastactive}</span>
				<img title="����Ȩֵ" src="source/plugin/sikemi/images/{$down_image}" alt="normal" align="absmiddle"></span>
				<img title="�ϴ�Ȩֵ" src="source/plugin/sikemi/images/{$up_image}" alt="normal" align="absmiddle">
				
			</span><br/>
			<span style="padding-left:10px;">
				����û�е�¼����½��ſ�������Ŷ��<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">��¼</a>&nbsp;|
				<a href="member.php?mod=register" class="xi2">����ע��</a>
			</span>
			</div>
EOB;
		}
	}
}

?>
