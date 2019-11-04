<{extends file='layout.tpl'}>
<{block name="title"}>测试<{/block}>
<{block name="body"}>
            <div>
                <pre>
                    <{$context_data['test.output']|print_r}>
                </pre>
            </div>
            <div>
                <pre>
                    <{$context_data['test.output1']|print_r}>
                </pre>
            </div>
<{/block}>
